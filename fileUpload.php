<?php

class upload
{
    public $fileDirectory;
    public $file;
    
    // Image, PDF or something IDK is it necessary.
    public $fileFormat;

    // 10 MB default
    public $fileSize = 10;

    // 1 MB in Binary as Byte
    public $fileSizeMultiplier = 1048576;
    public $maxFileSize;

    public $finalTitle;

    // 0 stands for not successfully uploaded, 1 stands for uploaded
    public $uploadState = true;

    function __construct ($fileDirectory, $file, $fileFormat, $fileSize)
    {
        $this->fileDirectory = $fileDirectory;
        $this->file = $file;
        $this->fileFormat = $fileFormat;
        $this->fileSize = $fileSize;
    }

    function getFileSize()
    {
        $fileSize = $this->file["size"];
        return $fileSize;
    }

    function fileSizeProcess()
    {
        $this->maxFileSize = $this->fileSizeMultiplier * $this->fileSize;
        return $this->maxFileSize;
    }

    function getExtension()
    {
        $path = $this->file['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        return $ext;
    }

    function renameFile()
    {
        $randNumber = rand();
        $title = date("H.i.s")."-".date("d.m.Y")."-".$randNumber.".".$this->getExtension();
        return $title;
    }

    public function upload()
    {
        $extension = $this->getExtension();
        if ($this->fileFormat == "image") {
            if ($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif")
            {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $this->uploadState = false;
            }
        }

        if ($this->fileFormat == "document")
        {
            if ($extension != "pdf" && 
            $extension != "docx" && 
            $extension != "doc" && 
            $extension != "xlsx" &&
            $extension != "xls" &&
            $extension != "pptx" &&
            $extension != "ppt" &&
            $extension != "txt"){
                echo "Sorry, only <b>docx, doc, xlsx, xls, pptx, ppt, txt</b> files are allowed.";
                $this->uploadState = false;
            }
        }

        if ($this->fileFormat == "csv")
        {
            if ($extension != "csv")
            {
                echo "Sorry, only <b>csv</b> file is allowed.";
                $this->uploadState = false;
            }
        }

        if($this->uploadState == true)
        {
            if ($this->fileSizeProcess() >= $this->getFileSize())
            {
                $this->finalTitle = $this->renameFile();
                $title = $this->fileDirectory.$this->finalTitle;
                $up = move_uploaded_file($this->file['tmp_name'], $title);
                if( $up )
                {
                    
                } else {
                    echo "Upload was not successful!";
                }
            } else {
                $this->uploadState = false;
                echo "File size exceeded!";
            }
            
        }
        return $this->finalTitle;
    }


}


?>