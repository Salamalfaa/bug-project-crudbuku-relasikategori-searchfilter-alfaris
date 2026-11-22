@extends('layouts.app')

@section('title', 'Buku dan Kategori')

@section('content')
    <section class="mb-8 flex flex-col items-start justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-violet-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-violet-800">
                <span class="h-2 w-2 rounded-full bg-violet-600"></span>
                Koleksi terhubung
            </span>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Buku dan Kategori</h1>
            <p class="mb-0 mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">Setiap buku terhubung ke kategorinya agar koleksi mudah dipahami dan dikelola.</p>
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-primary inline-flex items-center gap-2 rounded-xl px-4 py-3 font-semibold shadow-lg shadow-blue-700/20 transition hover:-translate-y-0.5 hover:shadow-xl">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            Tambah Buku
        </a>
    </section>

    <section class="card overflow-hidden rounded-3xl border-0 bg-white shadow-xl shadow-slate-900/5 ring-1 ring-slate-200/80">
        <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h2 class="mb-1 text-base font-bold text-slate-900">Daftar koleksi</h2>
                <p class="mb-0 text-sm text-slate-500">Nama kategori dimuat bersama buku untuk menjaga tampilan tetap cepat.</p>
            </div>
            <span class="inline-flex w-fit items-center rounded-full bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700">{{ $books->count() }} buku</span>
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
                                <span class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-800">
                                    <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span>
                                    {{ $book->category?->name ?? 'Kategori tidak tersedia' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-14 text-center">
                                <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50 text-violet-700">
                                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6.5A2.5 2.5 0 0 1 6.5 4H20v15H6.5A2.5 2.5 0 0 0 4 21.5v-15Zm0 0V20m4-12h8m-8 4h5" />
                                    </svg>
                                </span>
                                <p class="mb-1 mt-4 font-semibold text-slate-900">Belum ada buku.</p>
                                <p class="mb-0 text-sm text-slate-500">Tambahkan buku dan pilih kategori untuk membuat relasi pertama.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
