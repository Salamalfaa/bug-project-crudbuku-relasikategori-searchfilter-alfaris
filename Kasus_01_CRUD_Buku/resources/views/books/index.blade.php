@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <section class="mb-8 flex flex-col items-start justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-blue-800">
                <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                Koleksi buku
            </span>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Daftar Buku</h1>
            <p class="mb-0 mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">Atur koleksi, periksa informasi terbit, dan tambahkan buku baru dengan mudah.</p>
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
                <h2 class="mb-1 text-base font-bold text-slate-900">Koleksi tersimpan</h2>
                <p class="mb-0 text-sm text-slate-500">Daftar buku yang sudah tercatat di perpustakaan.</p>
            </div>
            <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                {{ $books->count() }} buku
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark bg-slate-900 text-xs uppercase tracking-[0.14em] text-slate-200">
                    <tr>
                        <th scope="col" class="px-5 py-4 font-semibold sm:px-6">Judul</th>
                        <th scope="col" class="px-5 py-4 font-semibold">Penulis</th>
                        <th scope="col" class="px-5 py-4 font-semibold">Tahun terbit</th>
                        <th scope="col" class="px-5 py-4 text-end font-semibold sm:px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="font-semibold text-slate-900">{{ $book->title }}</span>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $book->author }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-lg bg-indigo-50 px-2.5 py-1 text-sm font-semibold text-indigo-700">{{ $book->published_year }}</span>
                            </td>
                            <td class="px-5 py-4 text-end sm:px-6">
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger inline-flex items-center gap-1.5 rounded-lg px-3 py-2 font-semibold transition hover:-translate-y-0.5">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16m-10 4v6m4-6v6M5 7l1 13h12l1-13M9 7V4h6v3" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-14 text-center">
                                <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14m0-14C10.6 5.8 8.7 5 6.5 5A9.5 9.5 0 0 0 3 5.7v14A9.5 9.5 0 0 1 6.5 19c2.2 0 4.1.8 5.5 2m0-14c1.4-1.2 3.3-2 5.5-2A9.5 9.5 0 0 1 21 5.7v14a9.5 9.5 0 0 0-3.5-.7c-2.2 0-4.1.8-5.5 2" />
                                    </svg>
                                </span>
                                <p class="mb-1 mt-4 font-semibold text-slate-900">Belum ada data buku.</p>
                                <p class="mb-0 text-sm text-slate-500">Tambahkan buku pertama untuk mulai mengisi koleksi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
