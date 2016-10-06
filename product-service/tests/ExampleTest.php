<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    use DatabaseTransactions;
    protected $jsonHeaders = ['CONTENT_TYPE' => 'application/json',
        'Accept' => 'application/json'];

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Laravel');
    }

    public function testProductsList()
    {
        $products = factory(App\product::class, 3)->create();

        $this->get(route('products.index'))
            ->assertResponseOk();

        array_map(function ($product) {
            $this->seeJson($product->jsonSerialize());
        }, $products->all());
    }

//    public function testProductDescriptionsList()
//    {
//        $product = factory(App\product::class, 1)->create();
//        $product->descriptions()->saveMany(factory(App\description::class, 3)->make());
//
//        $this->get(route('products.descriptions.index', ['products' => $product->id]))
//            ->assertResponseOk();
//
//        array_map(function ($description) {
//            $this->seeJson($description->jsonSerialize());
//        }, $product->descriptions->all());
//    }

    public function testProductCreation()
    {
        $product = factory(App\product::class)->make(['name' => 'beets']);
        $this->post(route('products.store'), $product->jsonSerialize())
            ->seeInDatabase('products', ['name' => $product->name])
            ->assertResponseOk();
    }


    public function testProductDescriptionCreation()
    {
        $product = factory(App\product::class)->create(['name' => 'beets']);
        $description = factory(App\description::class)->make();
        $this->post(route('products.descriptions.store',['products'=>$product->id]), $description->jsonSerialize())
            ->seeInDatabase('descriptions', ['body' => $description->body])
            ->assertResponseOk();
    }
}
