

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php 
$errMsg = "";
try {
	$dsn = "mysql:host=localhost;port=3306;dbname=dd102g4_test;charset=utf8";
	$user = "root";
	$password = "123456/";
	$options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
	$pdo = new PDO($dsn, $user, $password, $options);

	$sql = "select r.que_repono, q.que_no,  q.que_title,q.que_desc, r.mem_no, r.time, r.reason, r.que_status from question_report r  join member_question q  on  r.que_no=q.que_no";
	$question_report  = $pdo->query($sql);

} catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="#">En-galaxy</a>
      </li>
      <li class="breadcrumb-item">
        <a href="#">檢舉管理</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">問題檢舉管理</li>
      <!--麵包屑-->
    </ol>
  </nav>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">問題檢舉編號</th>
      <th scope="col">問題編號</th>
      <th scope="col">問題標題</th>
      <th scope="col">問題描述</th>
      <th scope="col">檢舉會員ID</th>
      <th scope="col">檢舉時間</th>
      <th scope="col">檢舉原因</th>
      <th scope="col">檢舉成立狀態</th>
    </tr>
  </thead>
  <tbody>
  <?php 
	while( $que_reportRow = $question_report->fetch(PDO::FETCH_ASSOC)){
	
	?>
    <tr>
      <th scope="row"><?=$que_reportRow["que_repono"]?></th>
      <td><?=$que_reportRow["que_no"]?></td>
      <td><?=$que_reportRow["que_title"]?></td>
      <td><?=$que_reportRow["que_desc"]?></td>
      <td><?=$que_reportRow["mem_no"]?></td>
      <td><?=$que_reportRow["time"]?></td>
      <td><?=$que_reportRow["reason"]?></td>
      
      <td><label class="switch switch-label switch-pill switch-outline-primary-alt">
        <input class="switch-input" type="checkbox" checked="<?=$que_reportRow["que_status"]?>">
        <span class="switch-slider" data-checked="成立" data-unchecked="不成立"></span>
        </label></td>
    </tr>
    <?php
  }
  ?>
    </tbody>
</table>



<ul class="pagination">
  <li class="page-item">
  <a class="page-link" href="#">Prev</a>
  </li>
  <li class="page-item active">
  <a class="page-link" href="#">1</a>
  </li>
  <li class="page-item">
  <a class="page-link" href="#">2</a>
  </li>
  <li class="page-item">
  <a class="page-link" href="#">3</a>
  </li>
  <li class="page-item">
  <a class="page-link" href="#">4</a>
  </li>
  <li class="page-item">
  <a class="page-link" href="#">Next</a>
  </li>
  </ul>
<script type="text/javascript">
    $(document).ready(jQuery(function($) {
        //initiate dataTables plugin
        var myTable = 
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable( {
            bAutoWidth: false,
            "aoColumns": [
              { "bSortable": false },
              null, null, null, null,null,null,null,
              { "bSortable": false }//!!!!增加或減少欄位要改這裡!!!!!!null,
            ],
            "aaSorting": [],
            
            
            //"bProcessing": true,
            //"bServerSide": true,
            //"sAjaxSource": "http://127.0.0.1/table.php"	,
    
            //,
            //"sScrollY": "200px",
            //"bPaginate": false,
    
            //"sScrollX": "100%",
            //"sScrollXInner": "120%",
            //"bScrollCollapse": true,
            //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
            //you may want to wrap the table inside a "div.dataTables_borderWrap" element
    
            //"iDisplayLength": 50
    
    
            select: {
                // style: 'multi'
            }
        } );
    
        
        
        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        
        new $.fn.dataTable.Buttons( myTable, {
            buttons: [
              {
                "extend": "colvis",
                "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                "className": "btn btn-white btn-primary btn-bold",
                columns: ':not(:first):not(:last)'
              },
              {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                "className": "btn btn-white btn-primary btn-bold"
              },
              {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                "className": "btn btn-white btn-primary btn-bold"
              },
              {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                "className": "btn btn-white btn-primary btn-bold"
              },
              {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                "className": "btn btn-white btn-primary btn-bold"
              },
              {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                "className": "btn btn-white btn-primary btn-bold",
                autoPrint: false,
                message: 'This print was produced using the Print button for DataTables'
              }		  
            ]
        } );
        myTable.buttons().container().appendTo( $('.tableTools-container') );
        
        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
            defaultCopyAction(e, dt, button, config);
            $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });
        
        
        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {
            
            defaultColvisAction(e, dt, button, config);
            
            
            if($('.dt-button-collection > .dropdown-menu').length == 0) {
                $('.dt-button-collection')
                .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                .find('a').attr('href', '#').wrap("<li />")
            }
            $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });
    
        ////
    
        setTimeout(function() {
            $($('.tableTools-container')).find('a.dt-button').each(function() {
                var div = $(this).find(' > div').first();
                if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                else $(this).tooltip({container: 'body', title: $(this).text()});
            });
        }, 500);
        
        
        
        
        
        // myTable.on( 'select', function ( e, dt, type, index ) {
        // 	if ( type === 'row' ) {
        // 		$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
        // 	}
        // } );
        // myTable.on( 'deselect', function ( e, dt, type, index ) {
        // 	if ( type === 'row' ) {
        // 		$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
        // 	}
        // } );
    
    
    
    
        /////////////////////////////////
        //table checkboxes
        // $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
        
        //select/deselect all rows according to table header checkbox
        // $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
        // 	var th_checked = this.checked;//checkbox inside "TH" table header
            
        // 	$('#dynamic-table').find('tbody > tr').each(function(){
        // 		var row = this;
        // 		if(th_checked) myTable.row(row).select();
        // 		else  myTable.row(row).deselect();
        // 	});
        // });
        
        //select/deselect a row when the checkbox is checked/unchecked
        // $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
        // 	var row = $(this).closest('tr').get(0);
        // 	if(this.checked) myTable.row(row).deselect();
        // 	else myTable.row(row).select();
        // });
    
    
    
        // $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
        // 	e.stopImmediatePropagation();
        // 	e.stopPropagation();
        // 	e.preventDefault();
        // });
        
        
        
        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        // var active_class = 'active';
        // $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
        // 	var th_checked = this.checked;//checkbox inside "TH" table header
            
        // 	$(this).closest('table').find('tbody > tr').each(function(){
        // 		var row = this;
        // 		if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
        // 		else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
        // 	});
        // });
        
        //select/deselect a row when the checkbox is checked/unchecked
        // $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
        // 	var $row = $(this).closest('tr');
        // 	if($row.is('.detail-row ')) return;
        // 	if(this.checked) $row.addClass(active_class);
        // 	else $row.removeClass(active_class);
        // });
    
        
    
        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        
        //tooltip placement on right or left
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();
    
            var off2 = $source.offset();
            //var w2 = $source.width();
    
            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
        
        
        
        
        /***************/
        // $('.show-details-btn').on('click', function(e) {
        // 	e.preventDefault();
        // 	$(this).closest('tr').next().toggleClass('open');
        // 	$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        // });
        /***************/
        
        
        
        
        
        /**
        //add horizontal scrollbars to a simple table
        $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
          {
            horizontal: true,
            styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
            size: 2000,
            mouseWheelLock: true
          }
        ).css('padding-top', '12px');
        */
    
    
    }));
</script>