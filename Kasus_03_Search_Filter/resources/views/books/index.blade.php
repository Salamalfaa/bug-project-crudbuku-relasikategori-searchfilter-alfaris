@extends('layouts.app')

@section('title', 'Pencarian Buku')

@section('content')
    <section class="mb-8">
        <span class="inline-flex items-center gap-2 rounded-full bg-cyan-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-cyan-800">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="7" />
                <path stroke-linecap="round" d="m16 16 4 4" />
            </svg>
            Temukan bacaan
        </span>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Pencarian dan Filter Buku</h1>
        <p class="mb-0 mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">Cari berdasarkan sebagian judul atau nama penulis, lalu persempit hasil berdasarkan kategori.</p>
    </section>

    <section class="card mb-6 overflow-hidden rounded-3xl border-0 bg-white shadow-xl shadow-slate-900/5 ring-1 ring-slate-200/80">
        <div class="border-b border-slate-100 px-5 py-5 sm:px-7">
            <h2 class="mb-1 text-base font-bold text-slate-900">Atur pencarian</h2>
            <p class="mb-0 text-sm text-slate-500">Kedua filter dapat digunakan bersamaan.</p>
        </div>
        <div class="card-body p-5 sm:p-7">
            <form action="{{ route('books.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-[minmax(0,1.4fr)_minmax(220px,1fr)_auto] md:items-end">
                <div>
                    <label for="keyword" class="form-label mb-2 text-sm font-semibold text-slate-700">Judul atau penulis</label>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <circle cx="11" cy="11" r="7" />
                            <path stroke-linecap="round" d="m16 16 4 4" />
                        </svg>
                        <input type="search" id="keyword" name="keyword" class="form-control rounded-xl border-slate-300 py-3 pl-11 pr-4 shadow-sm focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10" placeholder="Contoh: Laravel, Andi..." value="{{ $keyword }}" maxlength="255" autocomplete="off">
                    </div>
                </div>

                <div>
                    <label for="category" class="form-label mb-2 text-sm font-semibold text-slate-700">Kategori</label>
                    <select id="category" name="category" class="form-select rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10">
                        <option value="">Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row">
                    <button type="submit" class="btn btn-primary inline-flex items-center justify-center gap-2 rounded-xl px-4 py-3 font-semibold shadow-lg shadow-blue-700/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="11" cy="11" r="7" />
                            <path stroke-linecap="round" d="m16 16 4 4" />
                        </svg>
                        Cari
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-light rounded-xl border border-slate-200 px-4 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="card overflow-hidden rounded-3xl border-0 bg-white shadow-xl shadow-slate-900/5 ring-1 ring-slate-200/80">
        <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h2 class="mb-1 text-base font-bold text-slate-900">Hasil pencarian</h2>
                <p class="mb-0 text-sm text-slate-500">Buku yang cocok dengan kata kunci dan kategori pilihan.</p>
            </div>
            <span class="inline-flex w-fit items-center rounded-full bg-cyan-50 px-3 py-1.5 text-xs font-semibold text-cyan-800">{{ $books->count() }} hasil</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark bg-slate-900 text-xs uppercase tracking-[0.14em] text-slate-200">
                    <tr>
                        <th scope="col" class="px-5 py-4 font-semibold sm:px-6">Judul</th>
                        <th scope="col" class="px-5 py-4 font-semibold">Penulis</th>
                        <th scope="col" class="px-5 py-4 font-semibold">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td class="px-5 py-4 sm:px-6"><span class="font-semibold text-slate-900">{{ $book->title }}</span></td>
                            <td class="px-5 py-4 text-slate-600">{{ $book->author }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full bg-cyan-50 px-3 py-1.5 text-xs font-semibold text-cyan-800">{{ $book->category?->name ?? 'Kategori tidak tersedia' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-14 text-center">
                                <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <circle cx="11" cy="11" r="7" />
                                        <path stroke-linecap="round" d="m16 16 4 4M8.5 11h5" />
                                    </svg>
                                </span>
                                <p class="mb-1 mt-4 font-semibold text-slate-900">Buku tidak ditemukan.</p>
                                <p class="mb-0 text-sm text-slate-500">Coba kata kunci lain atau reset filter untuk melihat semua buku.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
