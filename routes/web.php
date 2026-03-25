<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

function laracussDummyThreads(): array
{
    return [
        1 => [
            'id' => 1,
            'title' => 'Kenapa “Class not found” saat panggil controller?',
            'tags' => ['Laravel', 'Controller'],
            'authorName' => 'Rafi',
            'postedAgo' => '2 jam lalu',
            'content' => [
                'Saya sudah buat controller dan mapping route, tapi saat akses route muncul error “Class not found”.',
                'Apa yang biasanya menyebabkan class yang dipanggil tidak bisa ditemukan oleh Laravel (namespace/file path).',
            ],
            'replies' => [
                ['name' => 'Siti', 'ago' => '1 jam lalu', 'message' => 'Coba pastikan namespace controller sesuai dengan struktur folder dan `use` statements.', 'likeCount' => 5],
                ['name' => 'Bima', 'ago' => '45 menit lalu', 'message' => 'Kalau pakai class-based routing, pastikan nama class dan path file benar.', 'likeCount' => 2],
            ],
        ],
        2 => [
            'id' => 2,
            'title' => 'Event listener tidak jalan walau tidak ada error',
            'tags' => ['JavaScript', 'Debugging'],
            'authorName' => 'Siti',
            'postedAgo' => '5 jam lalu',
            'content' => [
                'Tombol/aksi di halaman tidak memanggil fungsi yang saya buat. Tidak ada error yang kelihatan, tapi kliknya seperti tidak terjadi apa-apa.',
                'Saya pakai Vite, script di-import dari `resources/js`, dan event handler dipasang setelah halaman render.',
            ],
            'replies' => [
                ['name' => 'Rafi', 'ago' => '4 jam lalu', 'message' => 'Coba cek elemen yang dituju selector-nya (apakah benar-benar ada di DOM saat listener dipasang).', 'likeCount' => 1],
            ],
        ],
        3 => [
            'id' => 3,
            'title' => 'Cara rapikan struktur Blade & SCSS agar scalable?',
            'tags' => ['Architecture', 'SCSS/Blade'],
            'authorName' => 'Bima',
            'postedAgo' => '1 hari lalu',
            'content' => [
                'View Blade makin banyak duplikat dan SCSS makin panjang karena style bercampur aduk.',
                'Saya ingin struktur yang enak untuk tim: ada layout/partials yang jelas, dan style per halaman/komponen yang mudah dicari dan dipakai ulang.',
            ],
            'replies' => [
                ['name' => 'Siti', 'ago' => '23 jam lalu', 'message' => 'Pisahkan style per halaman/komponen via folder, lalu gunakan partial/entry yang jelas.', 'likeCount' => 4],
                ['name' => 'Rafi', 'ago' => '20 jam lalu', 'message' => 'Buat konsistensi naming class dan hindari style yang terlalu global.', 'likeCount' => 2],
            ],
        ],
    ];
}

Route::middleware('auth')->group(function () {
    // Create discussion (UI placeholder, belum tersimpan ke DB)
    Route::get('/discussion/create', function () {
        return view('discussion-create');
    });

    Route::post('/discussion/create', function (\Illuminate\Http\Request $request) {
        return redirect('/discussion')->with('status', 'Create discussion belum diaktifkan (placeholder UI).');
    });

    // Edit discussion (UI placeholder, belum tersimpan ke DB)
    Route::get('/discussion/{id}/edit', function ($id) {
        $threads = laracussDummyThreads();
        $thread = $threads[(int) $id] ?? null;

        if (!$thread) {
            return redirect('/discussion')->with('status', 'Thread tidak ditemukan.');
        }

        return view('discussion-edit', [
            'thread' => $thread,
        ]);
    })->where('id', '[0-9]+');

    Route::post('/discussion/{id}/edit', function ($id) {
        return redirect('/discussion/' . $id)->with('status', 'Edit discussion belum diaktifkan (placeholder UI).');
    })->where('id', '[0-9]+');
});

Route::get('/discussion/{id?}', function ($id = null) {
    if ($id) {
        $threads = laracussDummyThreads();
        $thread = $threads[(int) $id] ?? $threads[1];

        return view('discussion', [
            'isDetail' => true,
            'thread' => $thread,
        ]);
    }

    return view('discussion', ['isDetail' => false]);
})->where('id', '[0-9]+');

// Profile user (dummy data)
function laracussDefaultProfileData(string $userName): array
{
    return [
        'displayName' => $userName,
        'bio' => 'Saya aktif berdiskusi seputar web development di Laracuss.',
        'location' => 'Indonesia',
        'photo' => '',
    ];
}

function laracussResolveProfileData(\Illuminate\Http\Request $request, string $userName): array
{
    $default = laracussDefaultProfileData($userName);
    $authUser = Auth::user();

    if ($authUser && (string) ($authUser->username ?? '') === $userName) {
        $default['displayName'] = (string) $authUser->username;
        $default['photo'] = (string) ($authUser->picture ?? '');
    }

    $overrides = $request->session()->get('profile_overrides', []);
    $saved = $overrides[$userName] ?? [];

    return array_merge($default, is_array($saved) ? $saved : []);
}

function laracussResolvePasswordHash(\Illuminate\Http\Request $request, string $userName): string
{
    $hashes = $request->session()->get('profile_password_hashes', []);
    if (isset($hashes[$userName]) && is_string($hashes[$userName])) {
        return $hashes[$userName];
    }

    return Hash::make('password123');
}

function laracussAuthorizeProfileOwner(?string $requestedName): string
{
    $authUser = Auth::user();
    $authUsername = is_object($authUser) ? (string) ($authUser->username ?? '') : '';

    if ($authUsername === '') {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    if ($requestedName !== null && $requestedName !== '' && $requestedName !== $authUsername) {
        abort(403, 'Anda hanya dapat mengedit profil milik sendiri.');
    }

    return $authUsername;
}

Route::middleware('auth')->group(function () {
    Route::get('/profile/{name?}/edit', function (\Illuminate\Http\Request $request, $name = null) {
        $userName = laracussAuthorizeProfileOwner($name);
        $profileData = laracussResolveProfileData($request, $userName);

        return view('profile-edit', [
            'userName' => $userName,
            'profileData' => $profileData,
        ]);
    })->where('name', '[A-Za-z0-9_-]+');

    Route::post('/profile/{name?}/edit', function (\Illuminate\Http\Request $request, $name = null) {
        $userName = laracussAuthorizeProfileOwner($name);

        $validated = $request->validate([
            'displayName' => ['required', 'string', 'max:60'],
            'bio' => ['nullable', 'string', 'max:280'],
            'location' => ['nullable', 'string', 'max:80'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['nullable', 'string', 'required_with:new_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed', 'required_with:current_password'],
        ]);

        $photoPath = '';
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $dir = public_path('uploads/profile');
            File::ensureDirectoryExists($dir);

            $filename = 'profile-' . strtolower($userName) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $photoPath = 'uploads/profile/' . $filename;
        }

        $profileOnly = [
            'displayName' => $validated['displayName'],
            'bio' => $validated['bio'] ?? '',
            'location' => $validated['location'] ?? '',
            'photo' => $photoPath !== '' ? $photoPath : (($request->session()->get('profile_overrides', [])[$userName]['photo'] ?? '')),
        ];

        $overrides = $request->session()->get('profile_overrides', []);
        $overrides[$userName] = $profileOnly;
        $request->session()->put('profile_overrides', $overrides);

        $authUser = Auth::user();
        if ($authUser && (string) ($authUser->username ?? '') === $userName && $photoPath !== '') {
            $authUser->picture = $photoPath;
            $authUser->save();
        }

        $passwordUpdated = false;
        $newPassword = $validated['new_password'] ?? '';

        if ($newPassword !== '') {
            $currentPassword = $validated['current_password'] ?? '';
            $currentHash = laracussResolvePasswordHash($request, $userName);

            if (!Hash::check($currentPassword, $currentHash)) {
                return back()
                    ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                    ->withInput();
            }

            $hashes = $request->session()->get('profile_password_hashes', []);
            $hashes[$userName] = Hash::make($newPassword);
            $request->session()->put('profile_password_hashes', $hashes);
            $passwordUpdated = true;
        }

        $status = $passwordUpdated
            ? 'Profil dan password berhasil diperbarui.'
            : 'Profil berhasil diperbarui.';

        return redirect('/profile/' . $userName)->with('status', $status);
    })->where('name', '[A-Za-z0-9_-]+');
});

Route::get('/profile/{name?}', function (\Illuminate\Http\Request $request, $name = null) {
    $threads = laracussDummyThreads();

    $userName = $name ?: (Auth::user()->username ?? 'Rafi');
    $profileData = laracussResolveProfileData($request, $userName);
    $questions = [];
    $answers = [];

    foreach ($threads as $thread) {
        if (($thread['authorName'] ?? null) === $userName) {
            $questions[] = $thread;
        }

        foreach (($thread['replies'] ?? []) as $replyIndex => $reply) {
            if (($reply['name'] ?? null) === $userName) {
                $answers[] = [
                    'thread' => $thread,
                    'reply' => $reply,
                    'replyIndex' => (int) $replyIndex,
                ];
            }
        }
    }

    return view('profile', [
        'userName' => $userName,
        'profileData' => $profileData,
        'questions' => $questions,
        'answers' => $answers,
    ]);
})->where('name', '[A-Za-z0-9_-]+');

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/search', function (\Illuminate\Http\Request $request) {
    $q = $request->query('q', '');
    return view('search', ['q' => $q]);
});

require __DIR__ . '/auth.php';
