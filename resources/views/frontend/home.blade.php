<!-- load file layout.badle.php vao day -->
@extends("frontend.layout")
@section("do-du-lieu")
<!-- ========================================= -->
	<?php 
		//chi lay cac danh muc co tin tuc
		$categories = DB::select("select * from categories order by id desc");
	 ?>
	 @foreach($categories as $itemCategory)
	 <?php 
	 	//kiem tra xem danh muc co bai tin thi moi cho hien thi danh muc do len
	 	$check = DB::table("news")->where("category_id","=",$itemCategory->id)->Count();
	  ?>
	  	@if($check > 0)
		    <!-- list category tin tuc -->
		    <div class="row-fluid">
		        <div class="marked-title">
		            <h3><a href="#" style="color:white">{{ $itemCategory->name }}</a></h3>
		        </div>
		    </div>                    
		    <div class="row-fluid">
		        <div class="span2">
		        	<?php 
		        		//lay mot ban ghi
		        		$first_news = DB::table("news")->where("category_id","=",$itemCategory->id)->offset(0)->take(1)->first();
		        	 ?>
		           <!-- first news -->
		            <article>
		                <div class="post-thumb">
		                    <a href="{{ url('news/detail/'.$first_news->id) }}"><img src="{{ asset('upload/news/'.$first_news->photo) }}" alt=""></a>
		                </div>
		                <div class="cat-post-desc">
		                    <h3><a href="{{ url('news/detail/'.$first_news->id) }}">{{ $first_news->name }}</a></h3>
		                    <p>{!! $first_news->description !!}</p>
		                </div>
		            </article>
		            <!-- end first news -->
		        </div>
		        <div class="span2">
		        <?php 
		        	//lay 3 ban ghi tiep theo sau ban ghi dau tien (ban ghi dau tien da dung o tren)
		        	$other_news = DB::table("news")->where("category_id","=",$itemCategory->id)->offset(1)->take(3)->get();
		         ?>
		         @foreach($other_news as $rows)
		           <!-- list news -->
		            <article class="twoboxes">
		                <div class="right-desc">
		                    <h3><a href="{{ url('news/detail/'.$rows->id) }}"><img src="{{ asset('upload/news/'.$rows->photo) }}" alt=""></a><a href="{{ url('news/detail/'.$rows->id) }}">{{ $rows->name }}</a></h3>  
		                      
		                </div>
		                
		            </article>
		            <!-- end list news -->
		         @endforeach
		        </div>
		    </div>
		    <div class="clear"></div>
		    <!-- end list category tin tuc -->
    	@endif
    @endforeach
    
 <!-- ========================================= -->
@endsection