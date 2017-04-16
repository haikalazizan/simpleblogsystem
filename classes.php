<?php

class Master
{
	public $titlePage;
	public $setRootPage;
	public $setOwner;
	public $setYear;
	public $setTopicState;
	public $setDlState;
	public $thumbnailImage;

	public function __construct()
	{
		if(isset($_GET['p']))
		{
			$page = $_GET['p'] . ".txt";
			if(file_exists($page))
			{
				$title = str_ireplace("_", " ", $_GET['p']);
				$title = ucwords($title);
			}
			elseif($_GET['p'] == "")
			{
				$title = "Home";
			}
			else
			{
				$title = "404 Not Found";
			}
		}
		else
		{
			$title = "Home";
		}
		$this->titlePage = $title;
	}

	public function grabImage()
	{
		// $img = "";
		if(isset($_GET['p']))
		{
			$page = $_GET['p'] . ".txt";
			if(file_exists($page))
			{
				$file = file_get_contents($page);
				$matches = array();
				preg_match_all('![a-z0-9\-\.\/]+\.(?:jpe?g|png|gif)!Ui' , $file , $matches);
				$img = "http://haikalazizan.com/v2/". str_ireplace("./", "", $matches[0][0]);
			}
		}
		$this->thumbnailImage = $img;
	}

	public function pages()
	{
		if(isset($_GET['p']))
		{
			$page = $_GET['p'] . ".txt";
			if(file_exists($page))
			{
				include($page);
			}
			elseif($_GET['p'] == "")
			{
				include($this->setRootPage);
			}
			else
			{
				$html = "<div class='subcontent'><h2 class='title'>Document Error: 404</h2><div class='alert'>Page requested not found. If you want to create new page on this site, you can contact to our webmaster. <a href='./'>Back to home</a></div></div>";
				echo $html;
			}
		}
		else
		{
			include($this->setRootPage);
		}
	}

	public function footer()
	{
		$html = "<div style='clear: both;'></div><div class='subcontent' align='right' style='padding: 10px; color: black;'><small><i>&copy; {$this->setYear} {$this->setOwner}<br/>All Rights Reserved</i></small></div>";
		return $html;
	}

	public function topic($topics)
	{
		$state = $this->setTopicState;
		if($state == 0)
		{
			echo "<i>Topic(s) will be online soon.</i>";
		}

		elseif($state == 1)
		{
			echo "<ul class='list'>";
			foreach($topics as $topic => $date)
			{
				$link = $topic;
				$title = ucwords(str_ireplace("_", " ", $topic));
				echo "<li><a href='./{$link}'>{$title}<br/><small>&mdash; Created on {$date}</small></a></li>";
			}
			echo "</ul>";
		}
	}

	public function download($downloads)
	{
		$state = $this->setDlState;
		if($state == 0)
		{
			echo "<i>No files yet.</i>";
		}

		elseif($state == 1)
		{
			echo "<ul class='list'>";
			foreach($downloads as $title => $link)
			{
				echo "<li><a href='{$link}'>{$title}</a></li>";
			}
			echo "</ul>";
		}
	}
}


?>