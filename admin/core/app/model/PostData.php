<?php

class PostData
{
    public static $tablename = "post";


    public function __construct()
    {
        $this->id = null;
        $this->title = "";
        $this->title_es = "";
        $this->title_de = "";
        $this->brief = "";
        $this->brief_es = "";
        $this->brief_de = "";
        $this->content = "";
        $this->content_es = "";
        $this->content_de = "";
        $this->image = "";
        $this->category_id = "";
        $this->status = "";
        $this->destination = "";
        $this->created_at = "NOW()";
    }

    public function add()
    {
        $sql = "insert into " . self::$tablename . " (title,title_es,title_de,brief,brief_es,brief_de,content,content_es,content_de,category_id,destination,image,created_at) ";
        $sql .= 'value ("'
            . $this->title
            . '","' . $this->title_es
            . '","' . $this->title_de
            . '","' . $this->brief
            . '","' . $this->brief_es
            . '","' . $this->brief_de
            . '","' . $this->content
            . '","' . $this->content_es
            . '","' . $this->content_de
            . '",' . $this->category_id
            . ',' . $this->destination
            . ',"' . $this->image . '",NOW())';
        return Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from " . self::$tablename . " where id=$id";
        return Executor::doit($sql);
    }

    public function del()
    {
        $sql = "delete from " . self::$tablename . " where id=$this->id";
        return Executor::doit($sql);
    }

    // partiendo de que ya tenemos creado un objecto PostData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update " . self::$tablename . " set " .
            "title=\"$this->title\"," .
            "title_es=\"$this->title_es\"," .
            "title_de=\"$this->title_de\"," .
            "brief=\"$this->brief\"," .
            "brief_es=\"$this->brief_es\"," .
            "brief_de=\"$this->brief_de\"," .
            "content=\"$this->content\"," .
            "content_es=\"$this->content_es\"," .
            "content_de=\"$this->content_de\"," .
            "image=\"$this->image\"," .
            "category_id=\"$this->category_id\"," .
            "status=$this->status," .
            "destination=\"$this->destination\" " .
            "where id=$this->id";
        return Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new PostData());
    }

    public static function getAll()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new PostData());

    }

    public static function getAllActive()
    {
        $sql = "select * from " . self::$tablename . " where status=1";
        $query = Executor::doit($sql);
        return Model::many($query[0], new PostData());

    }

    public static function getLike($q)
    {
        $sql = "select * from " . self::$tablename . " where name like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new PostData());
    }


}
