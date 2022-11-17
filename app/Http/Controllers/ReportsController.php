<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;

class ReportsController extends Controller
{

    public function index()
    {
        $title = 'Отчеты';

        $postsCount = Post::count();
        $newsCount = News::count();
        $tagsCount = Tag::count();
        $commentsCount = Comment::count();
        $usersCount = User::count();

        return view('pages.reports', compact('title', 'postsCount', 'newsCount', 'tagsCount', 'commentsCount', 'usersCount'));
    }

    public function getExport(Post $posts, News $news, Tag $tag, Comment $comment, User $user)
    {

        $data[] = [
            $postsCount = Post::count(),
            $newsCount = News::count(),
            $tagsCount = Tag::count(),
            $commentsCount = Comment::count(),
            $usersCount = User::count()
        ];



        return Excel::create('yourfilename', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->cell('A1:C1',function($cell)
                {
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                });

                $sheet->cell('A:C',function($cell)
                {
                    $cell->setAlignment('center');
                });

                $sheet->cell('A1', function($cell)
                {
                    $cell->setValue('S.No');

                });
                $sheet->cell('B1', function($cell)
                {
                    $cell->setValue('Name');
                });
                $sheet->cell('C1', function($cell)
                {
                    $cell->setValue('Father Name');
                });
                if (!empty($data)) {
                    $sno=1;
                    foreach ($data as $key => $value)
                    {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $sno);
                        $sheet->cell('B'.$i, $value['name']);
                        $sheet->cell('C'.$i, $value['fathername']);
                        $sno++;
                    }
                }
            });
        })->download(xlsx);

//        return view('pages.exportsDone');
    }
}
