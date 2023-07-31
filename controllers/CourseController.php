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
            "course_title" => "required",
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
            "course_title" => "required",
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

    public static function saveLesson($request)
    {
        unset($request['tambah']);

        $validation = Validation::validate($request, [
            "course_id" => "required",
            "lesson_title" => "required",
            "embed_video" => "required",
            "description" => "required",
            "bab" => "required",
        ]);

        if ($validation) {
            $course_id = $request['course_id'];
            $lesson_title = $request['lesson_title'];
            $embed_video = self::embedYouTubeVideo($request['embed_video']); // Convert YouTube link to embedded format
            $lesson_description = $request['description'];
            $lesson_bab = $request['bab'];

            // Prepare the INSERT query using prepared statements to prevent SQL injection
            $connection = Database::connect();
            $stmt = mysqli_prepare($connection, "INSERT INTO learning_materials (course_id, title, embed_video, description, bab, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            mysqli_stmt_bind_param($stmt, "issss", $course_id, $lesson_title, $embed_video, $lesson_description, $lesson_bab);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                Session::session("success", "Lesson berhasil ditambahkan");
                redirect("/admin/detail-course?id=" . urlencode($course_id));
            } else {
                Session::session("error", "Gagal menyimpan lesson");
            }
        }
    }

    // Helper function to convert YouTube link to embedded format
    private static function embedYouTubeVideo($youtubeLink)
    {
        // Extract the YouTube video ID from the link
        $videoID = self::getYouTubeVideoID($youtubeLink);

        // Generate the embedded format
        return '<iframe class="w-100 h-100" src="https://www.youtube.com/embed/' . $videoID . '" title="dari kolom title" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
    }

    // Helper function to extract YouTube video ID from the link
    private static function getYouTubeVideoID($youtubeLink)
    {
        // Regular expression to match YouTube video ID from the link
        preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|vi|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtubeLink, $matches);

        // Return the video ID if found, otherwise return null
        return isset($matches[1]) ? $matches[1] : null;
    }

    public static function updateLesson($post, $id)
    {
        unset($post['update']);
    
        $validation = Validation::validate($post, [
            "course_title" => "required",
            "title" => "required",
            "embed_video" => "required",
            "description" => "required",
            "bab" => "required",
        ]);
    
        if ($validation) {
            // Get the existing embed_video value from the database
            $materi = Database::getFirst("SELECT * FROM learning_materials WHERE id='$id'");
            $existing_embed_video = $materi['embed_video'];
    
            // If the input embed_video is not a valid YouTube link, use the existing value
            $videoID = self::getYouTubeVideoID($post['embed_video']);
            $embed_video = $videoID ? self::embedYouTubeVideo($videoID) : $existing_embed_video;
    
            // Update the learning_materials table
            $learningMaterialData = [
                'title' => $post['title'],
                'embed_video' => $embed_video,
                'description' => $post['description'],
                'bab' => $post['bab'],
            ];
    
            Database::update("learning_materials", $learningMaterialData, $id);
    
            // Redirect back to the detail course page
            $course_id = $materi['course_id'];
            Session::session("success", "Update success");
            redirect("/admin/detail-course?id=" . urlencode($course_id));
        }
    }
    
    public static function getYouTubeIDFromEmbed($embedVideo)
    {
        preg_match('/youtube\.com\/embed\/([^"?]+)/', $embedVideo, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }
    private static function getYouTubeLinkFromID($videoID)
    {
        return 'https://www.youtube.com/watch?v=' . $videoID;
    }



    public static function delete($id)
    {
        $course = Database::getFirst("SELECT course_title FROM course WHERE id='$id'");
        Database::delete("course", $id);
        Session::session("success", "Data $course[course_title] berhasil dihapus");
        redirect("/admin/course");
    }


    public static function takeCourse($request){
        $valid=Validation::validate($request,[
            "take_course"=>"required",
        ]);

        if($valid){
            $user=Session::auth();
            Database::insert("courses_taken",[
                "user_id"=>$user['id'],
                "course_id"=>$request['take_course'],
                "created_at"=>$request['created_at'] = Locale::now(),
            ]);
            Session::session("success","Berhasil mengambil course");
            redirect("/student/take-course");
        }
    }

}
