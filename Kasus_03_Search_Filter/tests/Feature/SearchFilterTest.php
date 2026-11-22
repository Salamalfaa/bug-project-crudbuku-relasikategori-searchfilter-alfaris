<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_seeded_collection_is_shown(): void
    {
        $this->assertDatabaseCount('categories', 3);
        $this->assertDatabaseCount('books', 6);

        $this->get('/books')
            ->assertOk()
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('Belajar Python')
            ->assertSee('6 hasil');
    }

    public function test_partial_search_matches_titles_and_authors_and_keeps_keyword(): void
    {
        $this->get('/books?keyword=Lara')
            ->assertOk()
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('value="Lara"', false)
            ->assertDontSee('Belajar Python');

        $this->get('/books?keyword=nd')
            ->assertOk()
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('Andi')
            ->assertDontSee('Belajar Python');
    }

    public function test_keyword_and_category_filters_are_both_applied(): void
    {
        $technology = Category::where('name', 'Teknologi')->firstOrFail();

        $this->get('/books?keyword=Andi&category=' . $technology->id)
            ->assertOk()
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('value="Andi"', false)
            ->assertSee('value="' . $technology->id . '"', false);

        $this->get('/books?keyword=Akuntansi&category=' . $technology->id)
            ->assertOk()
            ->assertSee('Buku tidak ditemukan.')
            ->assertDontSee('Pengantar Akuntansi');
    }

    public function test_reset_returns_full_collection_without_filter_values(): void
    {
        $technology = Category::where('name', 'Teknologi')->firstOrFail();

        $this->get('/books?keyword=Lara&category=' . $technology->id)
            ->assertOk()
            ->assertSee('Reset')
            ->assertSee('value="Lara"', false);

        $this->get('/books')
            ->assertOk()
            ->assertSee('6 hasil')
            ->assertSee('Laravel untuk Pemula')
            ->assertSee('value=""', false)
            ->assertDontSee('value="Lara"', false);
    }
}
