<?php
namespace Coindb\Controllers;

class Tag
{
    private $tagsTable;

    public function __construct(\FrameWork\DatabaseTable $tagsTable)
    {
        $this -> tagsTable = $tagsTable;
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $tag = $this -> tagsTable -> findById($_GET['id']);
        }

        $title = 'Edit Tags';

        return ['template' => 'edittags.html.php',
          'title' => $title,
          'variables' => [
          'tag' => $tag ?? null
          ]
          ];
    }

    public function saveEdit()
    {
        $tag = $_POST['tag'];

        $this -> tagsTable -> save($tag);

        header('location: /tag/list');
    }

    public function list()
    {
        $tags = $this -> tagsTable -> findAll();

        $title = 'Tags List';

        return ['template' => 'tags.html.php',
              'title' => $title,
              'variables' => [
                'tags' => $tags
              ]
              ];
    }

    public function delete()
    {
        $this -> tagsTable -> delete($_POST['id']);

        header('location: /tag/list');
    }
}