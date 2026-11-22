@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <section class="mx-auto max-w-3xl">
        <a href="{{ route('books.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-violet-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6M9 12h12" />
            </svg>
            Kembali ke koleksi
        </a>

        <div class="mb-6">
            <span class="inline-flex rounded-full bg-violet-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-violet-800">Entri berkategori</span>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Tambah Buku</h1>
            <p class="mb-0 mt-2 text-slate-600">Pilih kategori yang sesuai agar buku tersimpan pada relasi yang benar.</p>
        </div>

        <div class="card overflow-hidden rounded-3xl border-0 bg-white shadow-xl shadow-slate-900/5 ring-1 ring-slate-200/80">
            <div class="border-b border-slate-100 px-5 py-5 sm:px-8">
                <h2 class="mb-1 text-base font-bold text-slate-900">Informasi buku</h2>
                <p class="mb-0 text-sm text-slate-500">Semua kolom wajib diisi.</p>
            </div>
            <div class="card-body p-5 sm:p-8">
                <form action="{{ route('books.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="title" class="form-label mb-2 text-sm font-semibold text-slate-700">Judul buku <span class="text-rose-600">*</span></label>
                        <input type="text" id="title" name="title" class="form-control rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 @error('title') is-invalid @enderror" value="{{ old('title') }}" maxlength="255" autocomplete="off" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="author" class="form-label mb-2 text-sm font-semibold text-slate-700">Penulis <span class="text-rose-600">*</span></label>
                        <input type="text" id="author" name="author" class="form-control rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 @error('author') is-invalid @enderror" value="{{ old('author') }}" maxlength="255" autocomplete="name" required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="form-label mb-2 text-sm font-semibold text-slate-700">Kategori <span class="text-rose-600">*</span></label>
                        <select id="category_id" name="category_id" class="form-select rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih kategori buku</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($categories->isEmpty())
                            <p class="mb-0 mt-2 text-sm text-amber-700">Belum ada kategori. Jalankan seeder kategori sebelum menambahkan buku.</p>
                        @endif
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('books.index') }}" class="btn btn-light rounded-xl border border-slate-200 px-4 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">Batal</a>
                        <button type="submit" @disabled($categories->isEmpty()) class="btn btn-primary inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 font-semibold shadow-lg shadow-blue-700/20 transition hover:-translate-y-0.5 hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-50">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                            </svg>
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
