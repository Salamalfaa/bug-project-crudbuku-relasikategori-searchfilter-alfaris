<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#111827">
    <title>@yield('title', 'BukuRuang') · BukuRuang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-yEPZ7jP9S0QKiUQ0m3jjsO4ProIW7wvR9gXkI7JOGa2XVsw53Yke2bsdkBbjmmiX" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { corePlugins: { preflight: false } };
    </script>
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-800 antialiased">
    <header class="bg-gradient-to-r from-slate-950 via-indigo-950 to-blue-900 shadow-xl shadow-slate-900/10">
        <nav class="container d-flex align-items-center justify-content-between py-3">
            <a class="d-flex align-items-center gap-3 text-decoration-none text-white" href="{{ route('books.index') }}">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-blue-100 ring-1 ring-white/20">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14m0-14C10.6 5.8 8.7 5 6.5 5A9.5 9.5 0 0 0 3 5.7v14A9.5 9.5 0 0 1 6.5 19c2.2 0 4.1.8 5.5 2m0-14c1.4-1.2 3.3-2 5.5-2A9.5 9.5 0 0 1 21 5.7v14a9.5 9.5 0 0 0-3.5-.7c-2.2 0-4.1.8-5.5 2" />
                    </svg>
                </span>
                <span class="flex flex-col">
                    <span class="text-[11px] font-semibold uppercase tracking-[0.22em] text-blue-200">Perpustakaan digital</span>
                    <span class="text-lg font-bold leading-tight tracking-tight">BukuRuang</span>
                </span>
            </a>
            <span class="hidden rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-medium tracking-wide text-blue-100 sm:inline-flex">RUANG KELOLA</span>
        </nav>
    </header>

    <main class="container mx-auto max-w-6xl px-3 py-8 sm:py-10">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-6 rounded-2xl border-0 shadow-sm ring-1 ring-emerald-200" role="status">
                <span class="font-semibold">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-6 rounded-2xl border-0 shadow-sm ring-1 ring-rose-200" role="alert">
                <p class="mb-2 font-semibold">Mohon periksa kembali data yang dimasukkan.</p>
                <ul class="mb-0 list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="container mx-auto max-w-6xl px-3 pb-8 text-center text-xs text-slate-500">
        Dibuat untuk membantu koleksi buku tetap tertata.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/js/bootstrap.bundle.min.js" integrity="sha384-WyOxWvTyr1QaMPfiPJSv76iReVthorl5uWlFtZPyK0IEB0hGzo9y5Bp9mYanr8Bu" crossorigin="anonymous"></script>
</body>
</html>
