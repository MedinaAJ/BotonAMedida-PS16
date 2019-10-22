<!-- minicskeleton front controller template -->
	<fieldset class="attribute_fieldset col-md-12">
	</fieldset>
	{foreach from=$link_custom item=link}
		<fieldset class="attribute_fieldset col-md-12">
			<link rel="stylesheet" type="text/css" href="https://www.ventadecolchones.com/modules/botonamedida/views/css/style.css"> 
			<div class="customField">
			<label class="attribute_label" for="group_4"> ¿No encuentra las medidas que busca?&nbsp;</label>
			<label class="switch "><input type="checkbox" value="0" id="check" onchange="javascript:showContent()" class="default"><span class="slider round"></span></label>
			</div>
		</fieldset>
	{/foreach}
	
<script type="text/javascript">

	if($("#check").length == 1) 
		check.checked = false;

    function showContent() {
        element = document.getElementById("custombutton");
        check = document.getElementById("check");
        if (check.checked) {
			window.open("{$link.link_custom_product}","_self");
            // element.style.display='block';
			//alert('si check');
        }
        else {
			//alert('no check');
           // element.style.display='none';
        }
    }
</script>
	

<!-- end minicskeleton front controller template -->