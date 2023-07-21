<?php

namespace Controllers;

use Config\Locale;
use Config\database;
use Validation\Validation;
use Config\Session;

class CourseController
{
    public static function update($post, $id)
    {

        // explode $post['class] dan buatkan array baru

        // unset update 
        unset($post['update']);

        // die;

        $validation = Validation::validate($post, [
            "course_title" => "required|unique:course",
            "description" => "required",
            "teacher_id" => "required",
            "class" => "required",
        ]);

        if ($validation) {
            $post['class'] = explode("|", $post['class']);
            $post['major'] = $post['class'][1];
            $post['class'] = $post['class'][0];

            Database::update("course", $post, $id);
            Session::session("success", "Update success");
            redirect("/admin/course");
        }
    }

    public static function insert($request)
    {

        unset($request['tambah']);

        $validation = Validation::validate($request, [
            "course_title" => "required|unique:course",
            "description" => "required",
            "teacher_id" => "required",
            "class" => "required",
        ]);

        

        if ($validation) {
            $request['class'] = explode("|", $request['class']);
            $request['major'] = $request['class'][1];
            $request['class'] = $request['class'][0];

            Database::insert("course", $request);
            Session::session("success", "Data $request[course_title] berhasil ditambahkan");
            redirect("/admin/course");
        }
    }
}
