<?php
/**
* 分页工具类
* author:		韩十七
* time:			2016/05/22
*/
class Page
{
	private $size_offset;//页数据大小偏移量
	private $count;//总记录数
	private $total;//总页数
	private $page_offset;//页码左右偏移量
	private $page_start;//开始页码
	private $page_end;//结束页码
	private $page;//当前页
	private $start;//数据查询起始ID

	/**
	 * 构造函数
	 * @param $count
	 * @param $size_offset  默认20条数据一页
	 * @param $page_offset  默认页码左右偏移3个
	 */
	public function __construct($count, $size_offset = 20, $page_offset = 3){
		$this->setCount($count);
		$this->setSizeOffset($size_offset);
		$this->setPageOffset($page_offset);
		$this->setPage();
		$this->setTotal();
		$this->setStart();
		$this->setPageStart();
		$this->setPageEnd();
	}

	//设置总记录数
	public function setCount($count){
		$this->count = $count;
	}

	//取得总记录数
	public function getCount(){
		return $this->count;
	}

	//设置页数据大小偏移量
	public function setSizeOffset($size_offset){
		$this->size_offset = $size_offset;
	}

	//取得页数据大小偏移量
	public function getSizeOffset(){
		return $this->size_offset;
	}
	//设置页码左右偏移量
	public function setPageOffset($page_offset){
		$this->page_offset = $page_offset;
	}

	//取得页码左右偏移量
	public function getPageOffset(){
		return $this->page_offset;
	}

	//设置总页数
	public function setTotal(){
		$this->total = ceil($this->count/$this->size_offset);
	}

	//取得总页数
	public function getTotal(){
		return $this->total;
	}

	//设置当前页
	public function setPage(){
		$this->page = isset($_GET['page']) ? $_GET['page'] : 1;
	}

	//取得当前页
	public function getPage(){
		return $this->page;
	}

	// 设置数据查询起始ID
	public function setStart(){
		$this->start = ($this->page - 1) * $this->size_offset;
	}

	//取得数据查询起始ID
	public function getStart(){
		return $this->start;
	}

	//设置开始页码
	public function setPageStart(){
		if($this->page - $this->page_offset < 1){
			$this->page_start = 1;
		}else{
			$this->page_start = $this->page - $this->page_offset;
		}
	}

	//取得开始页码
	public function getPageStart(){
		return $this->page_start;
	}

	//设置结束页码
	public function setPageEnd(){
		if($this->page + $this->page_offset > $this->total){
			$this->page_end = $this->total;
		}else{
			$this->page_end = $this->page + $this->page_offset;
		}
	}

	//取得结束页码
	public function getPageEnd(){
		return $this->page_end;
	}

	//分页方法
	public function page(){
		$page_html = "<ul>";
		if($this->page_start != 1){
			$page_html .= "<li><a href='?page=1'>1</a></li>";
		}
		for($i = $this->page_start; $i <= $this->page_end; $i++){
			if($i == $this->page){
				$page_html .= "<li><a href='javascript:;' class='cur'>". $i ."</a></li>";
			}else{
				$page_html .= "<li><a href='?page=". $i ."'>". $i ."</a></li>";
			}
		}

		if($this->page_end != $this->total){
			$page_html .= "<li><a href='?page=". $this->total ."'>". $this->total ."</a></li>";
		}
		$page_html .= "</ul>";
		return $page_html;
	}
}