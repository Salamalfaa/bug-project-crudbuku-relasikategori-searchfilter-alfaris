<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_list_and_create_form_render(): void
    {
        $this->get('/books')
            ->assertOk()
            ->assertSee('Belum ada data buku.');

        $this->get('/books/create')
            ->assertOk()
            ->assertSee('Tambah Buku');
    }

    public function test_invalid_data_shows_errors_and_preserves_valid_input(): void
    {
        $this->from('/books/create')
            ->post('/books', [
                'title' => '',
                'author' => '',
                'published_year' => now()->year + 1,
            ])
            ->assertRedirect('/books/create')
            ->assertSessionHasErrors(['title', 'author', 'published_year']);

        $this->from('/books/create')
            ->post('/books', [
                'title' => 'Judul valid',
                'author' => 'Penulis valid',
                'published_year' => now()->year + 1,
            ])
            ->assertRedirect('/books/create')
            ->assertSessionHasErrors('published_year')
            ->assertSessionHas('_old_input.title', 'Judul valid')
            ->assertSessionHas('_old_input.author', 'Penulis valid');

        $this->assertDatabaseCount('books', 0);
    }

    public function test_book_can_be_created_displayed_and_deleted(): void
    {
        $this->post('/books', [
            'title' => 'Laravel untuk Pemula',
            'author' => 'Andi',
            'published_year' => now()->year,
        ])->assertRedirect(route('books.index'));

        $book = Book::firstOrFail();

        $this->get('/books')
            ->assertOk()
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('Andi');

        $this->delete(route('books.destroy', $book))
            ->assertRedirect(route('books.index'));

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
