<?php

namespace Feature\Domain\Auth;
use Domain\User\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase{

    public function testLogin(){

        $data = [
            'email' => 'a@a.com',
            'username' => 'allan',
            'password' => bcrypt('emtudo123')
        ];
        factory(User::class)->create($data);

        $data = [
            'username' => 'a@a.com',
            'password' => 'emtudo123'
        ];
        $response=$this->call('POST','auth/login', $data);
        $this->assertEquals(200,$response->status());
//        $response->assertJson([
//            'username' => 'emtudo'
//        ]);


    }

    public function testLoginWithUsername(){

        $data = [
            'email' => 'a@a.com',
            'username' => 'allan',
            'password' => bcrypt('emtudo123')
        ];
        factory(User::class)->create($data);

        $data = [
            'username' => 'allan',
            'password' => 'emtudo123'
        ];
        $response=$this->call('POST','auth/login', $data);
        $this->assertEquals(200,$response->status());
//        $response->assertJson([
//            'username' => 'emtudo'
//        ]);


    }

    public function testCantLogin(){
        $data =[
            'username'=>uniqid(),
            'password'=>'teste'
        ];
        $response=$this->call('POST','auth/login', $data);
        $this->assertEquals(401,$response->status());
    }
}





















