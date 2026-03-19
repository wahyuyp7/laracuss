import './bootstrap';

import 'bootstrap';

// Discussion like (UI) for replies.
// Since the app currently uses dummy data (no DB), we persist like state in localStorage.
document.addEventListener('DOMContentLoaded', () => {
  const likeButtons = document.querySelectorAll('.discussion-reply-like-btn');
  if (!likeButtons.length) return;

  likeButtons.forEach((btn) => {
    const likeKey = btn?.dataset?.likeKey;
    if (!likeKey) return;

    const countEl = document.querySelector(`[data-like-count-key="${likeKey}"]`);
    if (!countEl) return;

    const initialCount = Number.parseInt(countEl.dataset.initialCount ?? '0', 10) || 0;
    const storageLikedKey = `laracuss_like_liked_${likeKey}`;
    const storageCountKey = `laracuss_like_count_${likeKey}`;

    let liked = false;
    let count = initialCount;

    try {
      liked = localStorage.getItem(storageLikedKey) === '1';
      const storedCount = localStorage.getItem(storageCountKey);
      if (storedCount !== null) {
        const parsed = Number.parseInt(storedCount, 10);
        count = Number.isNaN(parsed) ? initialCount : parsed;
      }
    } catch {
      // If storage is not available, just keep the initial UI state.
    }

    const render = () => {
      countEl.textContent = String(count);
      btn.setAttribute('aria-pressed', liked ? 'true' : 'false');

      // Switch between outline and solid styles.
      if (liked) {
        btn.classList.add('btn-primary');
        btn.classList.remove('btn-outline-primary');
      } else {
        btn.classList.add('btn-outline-primary');
        btn.classList.remove('btn-primary');
      }
    };

    render();

    btn.addEventListener('click', () => {
      liked = !liked;
      count = liked ? count + 1 : Math.max(0, count - 1);

      try {
        localStorage.setItem(storageLikedKey, liked ? '1' : '0');
        localStorage.setItem(storageCountKey, String(count));
      } catch {
        // Ignore storage errors; UI will still update.
      }

      render();
    });
  });
});

// Discussion share + copy link (detail view)
document.addEventListener('DOMContentLoaded', () => {
  const shareButtons = document.querySelectorAll('.discussion-share-btn');
  const copyButtons = document.querySelectorAll('.discussion-copy-link-btn');

  if (!shareButtons.length && !copyButtons.length) return;

  const temporarilySetButtonText = (btn, newText) => {
    const original = btn.textContent;
    btn.textContent = newText;
    setTimeout(() => {
      btn.textContent = original;
    }, 1500);
  };

  const copyText = async (text) => {
    if (navigator.clipboard?.writeText) {
      await navigator.clipboard.writeText(text);
      return true;
    }

    // Fallback: hidden textarea + execCommand
    try {
      const ta = document.createElement('textarea');
      ta.value = text;
      ta.setAttribute('readonly', '');
      ta.style.position = 'absolute';
      ta.style.left = '-9999px';
      document.body.appendChild(ta);
      ta.select();
      const ok = document.execCommand('copy');
      document.body.removeChild(ta);
      return ok;
    } catch {
      return false;
    }
  };

  shareButtons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const title = btn.dataset.shareTitle || 'Discussion';
      const url = btn.dataset.shareUrl || window.location.href;

      try {
        if (navigator.share) {
          await navigator.share({ title, text: title, url });
          return;
        }
      } catch {
        // If user cancels share dialog, do nothing.
        return;
      }

      // If Web Share API not supported, fallback to copy link.
      const ok = await copyText(url);
      if (ok) temporarilySetButtonText(btn, 'Link tersalin');
    });
  });

  copyButtons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const url = btn.dataset.copyUrl || window.location.href;
      const ok = await copyText(url);
      if (ok) temporarilySetButtonText(btn, 'Link tersalin');
    });
  });
});

// Discussion reply edit (UI only, localStorage-based)
document.addEventListener('DOMContentLoaded', () => {
  const messageEls = document.querySelectorAll('.discussion-reply-message[data-message-key]');
  if (!messageEls.length) return;

  const editButtons = document.querySelectorAll('.discussion-reply-edit-btn[data-edit-key]');
  if (!editButtons.length) return;

  const storagePrefix = 'laracuss_reply_message_';

  // Hydrate edited content (if any) on load
  messageEls.forEach((el) => {
    const editKey = el.dataset.messageKey;
    if (!editKey) return;

    try {
      const saved = localStorage.getItem(`${storagePrefix}${editKey}`);
      if (saved !== null) el.textContent = saved;
    } catch {
      // Ignore storage errors
    }
  });

  const showPanel = (editKey) => {
    const panel = document.querySelector(`[data-edit-panel-key="${editKey}"]`);
    const messageEl = document.querySelector(`[data-message-key="${editKey}"]`);
    if (!panel || !messageEl) return;

    const textarea = panel.querySelector('.discussion-reply-edit-textarea');
    if (textarea) textarea.value = messageEl.textContent;

    panel.classList.remove('d-none');
    messageEl.classList.add('d-none');
  };

  const hidePanel = (editKey) => {
    const panel = document.querySelector(`[data-edit-panel-key="${editKey}"]`);
    const messageEl = document.querySelector(`[data-message-key="${editKey}"]`);
    if (!panel || !messageEl) return;

    panel.classList.add('d-none');
    messageEl.classList.remove('d-none');
  };

  editButtons.forEach((btn) => {
    const editKey = btn.dataset.editKey;
    if (!editKey) return;

    btn.addEventListener('click', () => showPanel(editKey));
  });

  document.querySelectorAll('.discussion-reply-edit-save-btn[data-edit-save-key]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const editKey = btn.dataset.editSaveKey;
      if (!editKey) return;

      const panel = document.querySelector(`[data-edit-panel-key="${editKey}"]`);
      const messageEl = document.querySelector(`[data-message-key="${editKey}"]`);
      if (!panel || !messageEl) return;

      const textarea = panel.querySelector('.discussion-reply-edit-textarea');
      const nextValue = textarea ? textarea.value : '';

      try {
        localStorage.setItem(`${storagePrefix}${editKey}`, nextValue);
      } catch {
        // ignore
      }

      messageEl.textContent = nextValue;
      hidePanel(editKey);
    });
  });

  document.querySelectorAll('.discussion-reply-edit-cancel-btn[data-edit-cancel-key]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const editKey = btn.dataset.editCancelKey;
      if (!editKey) return;
      hidePanel(editKey);
    });
  });
});

// Profile share + copy link
document.addEventListener('DOMContentLoaded', () => {
  const shareButtons = document.querySelectorAll('.profile-share-btn');
  const copyButtons = document.querySelectorAll('.profile-copy-link-btn');

  if (!shareButtons.length && !copyButtons.length) return;

  const getLabel = (btn) => btn.querySelector('.profile-action-label');

  const temporarilySetProfileLabel = (btn, newText) => {
    const labelEl = getLabel(btn);
    const original = labelEl ? labelEl.textContent : btn.textContent;

    if (labelEl) labelEl.textContent = newText;
    else btn.textContent = newText;

    setTimeout(() => {
      if (labelEl) labelEl.textContent = original;
      else btn.textContent = original;
    }, 1500);
  };

  const copyText = async (text) => {
    if (navigator.clipboard?.writeText) {
      await navigator.clipboard.writeText(text);
      return true;
    }

    try {
      const ta = document.createElement('textarea');
      ta.value = text;
      ta.setAttribute('readonly', '');
      ta.style.position = 'absolute';
      ta.style.left = '-9999px';
      document.body.appendChild(ta);
      ta.select();
      const ok = document.execCommand('copy');
      document.body.removeChild(ta);
      return ok;
    } catch {
      return false;
    }
  };

  shareButtons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const title = btn.dataset.shareTitle || 'Profil';
      const url = btn.dataset.shareUrl || window.location.href;

      try {
        if (navigator.share) {
          await navigator.share({ title, text: title, url });
          return;
        }
      } catch {
        return;
      }

      const ok = await copyText(url);
      if (ok) temporarilySetProfileLabel(btn, 'Link tersalin');
    });
  });

  copyButtons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const url = btn.dataset.copyUrl || window.location.href;
      const ok = await copyText(url);
      if (ok) temporarilySetProfileLabel(btn, 'Link tersalin');
    });
  });
});
