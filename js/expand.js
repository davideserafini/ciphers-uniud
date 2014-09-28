$(document).ready(function(){
	
	$unMenus = $("div[data-expandheader]");
	
	// subcategories
	$unMenus.filter("[data-expandheader*='_']").each(function(){
		var $this = $(this);
		var expandId = $this.data('expandheader');
		var $contentDiv = $("div[data-expandcontent='"+expandId+"']");
		var contentDiv = $contentDiv.get(0);
		
		contentDiv["originalHeight"] = contentDiv["realHeight"] = contentDiv.clientHeight;
		$contentDiv.height('0px');
		
		$(this).bind('click', function(){
			$this = $(this);
			var expandId = $this.data('expandheader');
			var $contentDiv = $("div[data-expandcontent='"+expandId+"']");
			var contentDiv = $contentDiv.get(0);
			
			var collapsed = $this.hasClass('sub_header_collapsed');
			$parent = $this.parent();
			if (collapsed){
				$(".sub_header_expanded").trigger('click');
				$this.removeClass('sub_header_collapsed').addClass('sub_header_expanded');
				$parent.height(($parent.get(0)["originalHeight"] + contentDiv["realHeight"])+'px');
				$contentDiv.height(contentDiv["originalHeight"]+'px').removeClass('sub_content_collapsed').addClass('sub_content_expanded');
			} else {
				$this.removeClass('sub_header_expanded').addClass('sub_header_collapsed');
				$parent.height($parent.get(0)["originalHeight"]+"px");
				$contentDiv.height('0px').removeClass('sub_content_expanded').addClass('sub_content_collapsed');
			}
		})
	});
	
	// main categories
	$unMenus.not("[data-expandheader*='_']").each(function(){
		var $this = $(this);
		var expandId = $this.data('expandheader');
		var $contentDiv = $("div[data-expandcontent='"+expandId+"']");
		var contentDiv = $contentDiv.get(0);
		
		contentDiv["originalHeight"] = contentDiv["realHeight"] = contentDiv.clientHeight;
		$contentDiv.height('0px');
		
		$(this).bind('click', function(){
			$this = $(this);
			var expandId = $this.data('expandheader');
			var collapsed = $this.hasClass('header_collapsed');
			var $contentDiv = $("div[data-expandcontent='"+expandId+"']");
			var contentDiv = $contentDiv.get(0);

			if (collapsed){
				$(".header_expanded").trigger('click');
				$this.removeClass('header_collapsed').addClass('header_expanded');
				
				$contentDiv = $("div[data-expandcontent='"+expandId+"']");
				$contentDiv.height(contentDiv["originalHeight"]+"px").removeClass('content_collapsed').addClass('content_expanded');
			} else {
				$(".sub_header_expanded").trigger('click'); // close open subcategories, if any
				$this.removeClass('header_expanded').addClass('header_collapsed');
				$contentDiv = $("div[data-expandcontent='"+expandId+"']");
				$contentDiv.height('0px').removeClass('content_expanded').addClass('content_collapsed');
			}
		})
	});
})