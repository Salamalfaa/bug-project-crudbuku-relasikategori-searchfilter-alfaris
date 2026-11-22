<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
    }

    public function test_categories_are_seeded_and_form_uses_ids_with_names(): void
    {
        $this->assertSame(
            ['Akuntansi', 'Manajemen', 'Teknologi'],
            Category::orderBy('name')->pluck('name')->all()
        );

        $technology = Category::where('name', 'Teknologi')->firstOrFail();

        $this->get('/books/create')
            ->assertOk()
            ->assertSee('value="' . $technology->id . '"', false)
            ->assertSee('>Teknologi</option>', false);
    }

    public function test_books_store_and_display_their_category_relationships(): void
    {
        $technology = Category::where('name', 'Teknologi')->firstOrFail();
        $accounting = Category::where('name', 'Akuntansi')->firstOrFail();

        $this->post('/books', [
            'title' => 'Laravel untuk Pemula',
            'author' => 'Andi',
            'category_id' => $technology->id,
        ])->assertRedirect(route('books.index'));

        $this->post('/books', [
            'title' => 'Belajar Laravel',
            'author' => 'Budi',
            'category_id' => $technology->id,
        ])->assertRedirect(route('books.index'));

        $this->post('/books', [
            'title' => 'Dasar Akuntansi',
            'author' => 'Citra',
            'category_id' => $accounting->id,
        ])->assertRedirect(route('books.index'));

        $this->assertSame(2, $technology->books()->count());
        $this->assertSame(1, $accounting->books()->count());
        $this->assertSame(
            $technology->id,
            Book::where('title', 'Laravel untuk Pemula')->firstOrFail()->category->id
        );

        $this->get('/books')
            ->assertOk()
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('Teknologi')
            ->assertSee('Dasar Akuntansi')
            ->assertSee('Akuntansi');
    }

    public function test_unknown_category_is_rejected(): void
    {
        $this->from('/books/create')
            ->post('/books', [
                'title' => 'Buku tanpa kategori valid',
                'author' => 'Penulis',
                'category_id' => 999999,
            ])
            ->assertRedirect('/books/create')
            ->assertSessionHasErrors('category_id');

        $this->assertDatabaseCount('books', 0);
    }
}
