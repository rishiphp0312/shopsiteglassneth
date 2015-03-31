<?php
class Pagination 
{

	var $globalTotalCount;
	var $globalLimit;
	var $globalCurPage;
	
	function Pagination() 
	{
	}
	
	function getPageLinks($rowCount, $limit, $url, $currPage, $queryString, $showPrevNext)
	{
		$this->globalTotalCount = $rowCount;
		$this->globalLimit=$limit;
		$this->globalCurPage=$currPage;
		
		if ($rowCount > $limit)
		{
			$paginationText = "";
			$numberOfLinks = ($rowCount % $limit == 0) ? (int) ($rowCount / $limit) : ((int) ($rowCount / $limit)) + 1;
			$paginationText .= "<div id='pages'>";
			$paginationText .= "  <ul>";
			$linksFrom = 0;
			$linksTo = 0;
			$linkLimit=10;
			$start_page = max(1,$currPage-$linkLimit+1);
			$end_page = min($linkLimit+$start_page-1,$numberOfLinks);
		
			if ($showPrevNext)
			{
				if ($currPage != 1)
				{
					$link = "<a href='" . $url . "&pageNumber=" . ($currPage -1);
					if ($queryString != "")
					$link .= "&search=" . $queryString;
					$link .= "'> << Prev</a>";
				}
				else
				{
					$link = "<li class='nolink'> << Prev</li>";
				}
				$paginationText .= "<li>";
				$paginationText .= $link;
				$paginationText .= "</li>";
			}
		
			for ($i = $start_page  ; $i <= $end_page; $i++)
			{
				if ($currPage == $i)
				{
					$paginationText .= "<li class='current'>" . $i . "</li>";
				}
				else
				{
					$link = "<li><a href='" . $url . "&pageNumber=" . $i;
					if ($queryString != "")
					$link .= "&search=" . $queryString;
					$link .= "' >" . $i . "</a></li>";
					$paginationText .= $link;
				}
			}	
		
			if ($showPrevNext)
			{
				if ($currPage != $numberOfLinks)
				{
					$link = "<li><a href='" . $url . "&pageNumber=" . ($currPage +1);
					if ($queryString != "")
					$link .= "&search=" . $queryString;
					$link .= "' >Next >> </a></li>";
				}
				else
				{
					$link = "<li class='nolink'>Next >> </li>";
				}
				$paginationText .= $link;
			}
			$paginationText .= "  </ul>";
			$paginationText .= "</div>";
			
			/*$fromPage = (($currPage-1)*$limit)+1;
			$toPage = $currPage*$limit;
			$paginationText .= "displaying ".$fromPage." TO ".$toPage." of ".$rowCount;*/
			
			return $paginationText;
		}//end of if
		else
		{
			return "";
		}
	}//end of function
	
	function getPageCounter($currentCount)
	{
		$rowCount = $this->globalTotalCount;
		$limit = $this->globalLimit;
		$currPage = $this->globalCurPage;
		
		$fromPage = (($currPage-1)*$limit)+1;
		$toPage = (($currPage-1)*$limit)+ $currentCount;
		$paginationText = "<span>".$fromPage."-".$toPage."</span> of ".$rowCount." total";
		return $paginationText;;
	}
}//end class
?>