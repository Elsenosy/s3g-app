<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
class PermissionController extends Controller
{
    public function create(){
        $createArticle = new Permission();
        $createArticle->name         = 'create-article';
        $createArticle->display_name = 'Create articles'; // optional
        // Allow a user to...
        $createArticle->description  = 'Create blog articles'; // optional
        $createArticle->save();

        $editArticle = new Permission();
        $editArticle->name         = 'edit-article';
        $editArticle->display_name = 'Edit articles'; // optional
        // Allow a user to...
        $editArticle->description  = 'Edit blog articles'; // optional
        $editArticle->save();


        $deleteArticle = new Permission();
        $deleteArticle->name         = 'delete-article';
        $deleteArticle->display_name = 'Delete articles'; // optional
        // Allow a user to...
        $deleteArticle->description  = 'Delete blog articles'; // optional
        $deleteArticle->save();

        $author = \App\Role::where('name', 'author')->first();
        $editor = \App\Role::where('name', 'editor')->first();

        // $permission = Permission::where('name', 'edit-user')->first();

        $author->attachPermission([$createArticle, $editArticle, $deleteArticle]);

        $editor->attachPermission([$createArticle, $editArticle]);
        // dd($user);
    }
}
