<?php

namespace Tests\Feature;

use App\Products;
use App\User;
use Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function client_can_add_product_to_cart()
    {
        $client = factory(User::class)->create();

        $product = factory(Products::class)->create();

        $this->withoutExceptionHandling()->actingAs($client)->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 2
        ])->assertStatus(200);

        $this->assertTrue(Cart::get($product->id)['id'] == $product->id);
    }

    /** @test */
    function client_can_update_product_to_cart()
    {
        $client = factory(User::class)->create();

        $product = factory(Products::class)->create();

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 2
        ]);

        $this->withoutExceptionHandling()->actingAs($client)->put(route('cart.update', $product->id), [
            'quantity' => 4
        ])->assertStatus(302);

        $this->assertTrue(4 == Cart::get($product->id)['quantity']);
    }

    /** @test */
    function client_can_delete_item_to_cart()
    {
        $client = factory(User::class)->create();

        $product = factory(Products::class)->create();

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 2
        ]);

        $this->withoutExceptionHandling()->actingAs($client)->get(route('cart.delete', $product->id))->assertStatus(200);

        $this->assertTrue(Cart::isEmpty());
    }
}
