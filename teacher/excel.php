<?php

    include('../config.php');
    include('data/subject_model.php');
    include('data/student_model.php');
    include('data/criteria_model.php'); 
    $id = $_SESSION['id'];
    $q = "select * from teacher where teachid='$id'";
    $r = mysql_query($q);
    if($row = mysql_fetch_array($r)){
        $teacher = $row['fname'].' '.$row['lname'];
    }
    $classid = $_GET['classid'];
    $mystudent = $student->getstudentbyclass($classid);
    $mysubject = $subject->getsubjectbyid($classid);
	$sectionN = "";
	$subjectN = "";
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Print Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
	
	@media print {
  body * {
    visibility: hidden;
  }
  #print * {
    visibility: visible;
  }
  #print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
  button {
            margin-top: 5px;
        }
		
        .wrapper {
            margin-top:20px !important;            
            border:1px solid #777;
            background:#fff;
            margin:0 auto;
            padding: 20px;
        }
        body {
            background:#ccc;   
        }
        img {
            max-height:150px;   
            max-width:150px;   
            margin-right:10px;
        }
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            border-top: none !important;   
        }
        
    </style>
</head>
<body> 

       <div class="text-center">   
 <button type="button" name="submit"   onclick="window.print()"   class="btn btn-primary"><i class="fa fa-print"></i> Print Records</button>        
 <button type="button" name="submit"    onclick="tablesToExcel(['tblHeader','tblContent'], ['Class Information','Class Record'], 'ClassRecord.xlsx', 'Excel')"  class="btn btn-primary"><i class="fa fa-save"></i> Save to Excel</button>        
            </div> 
    <div  id = "print" class="container wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">                    
                    <h3><?php echo $_GET['classname'];?> Grade Sheet</h3> 
                    <hr />
                    <?php while($row = @mysql_fetch_array($mysubject)): ?>
                    <?php $mysubjectname = $subject->getsubjectbycode($row['subject']); ?>
                    <table id="tblHeader" class="table">
                        <thead>
                        <tr>
                            <td style="width:20%;text-align:left;font-weight: bold;">SUBJ CODE:</td>
                            <td style="width:*;text-align:left;"><?php echo $row['subject']; $subjectN = $row['subject']; ?></td>
                            <td style="width:10%;text-align:left;font-weight: bold;">DATE:</td>
                            <td style="width:25%;text-align:left;"><?php echo date('F d, Y')?></td>
                        </tr>
						 </thead>
						  <thead>
                        <tr>
                            <td class="text-left" style="width:10%;text-align:left;font-weight: bold;">SECTION:</td>
                            <td class="text-left"><?php echo $row['section']; $sectionN = $row['section'];?></td>
                            <td class="text-left" style="width:10%;text-align:left;font-weight: bold;">UNITS:</td>
                            <td class="text-left"><?php echo $mysubjectname['unit'];?></td>
                        </tr>
						 </thead>
						  <thead>
                        <tr>
                            <td class="text-left" style="width:10%;text-align:left;font-weight: bold;">SUBJ NAME:</td>
                            <td class="text-left"><?php echo $mysubjectname['title'];?></td>
                            <td class="text-left" style="width:10%;text-align:left;font-weight: bold;">S.Y :</td>
                            <td class="text-left"><?php echo $row['SY'];?></td>
                        </tr>
						 </thead>
						  <thead>
                        <tr>
                            <td class="text-left" style="width:10%;text-align:left;font-weight: bold;">INSTRUCTOR:</td>
                            <td class="text-left"><?php echo strtoupper($teacher);?></td>
                            <td class="text-left" style="width:10%;text-align:left;font-weight: bold;">COURSE:</td>
                            <td class="text-left"><?php echo $row['course'];?></td>
                        </tr>
						 </thead> 
                    </table>                    
                    <?php endwhile; ?>
                </div>               
            </div>
        </div> 
        
        
        
        <div class="row">
            <div class="col-lg-12">                

                <div class="">
				<?php  
	$criterialistmidterm = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialistfinals = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']);  
					?>
                    <table id="tblContent" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-center">Student's Name</th>
								<!--
                                <th class="text-center">Prelim</th>
								-->
								 <?php while($row3 = mysql_fetch_array($criterialistmidterm)): ?> 
                                 <th style="background-color:#efff00;"  class="text-center"><?php echo ucfirst($row3['criteria']);?></th> 
							 <?php endwhile; ?> 
                                <th style="background-color:#efff00;"   class="text-center">Midterm Total</th>
                                <th  style="background-color:#efff00;"  class="text-center">Midterm EQ.</th>
								
								 <?php while($row3 = mysql_fetch_array($criterialistfinals)): ?> 
                                 <th style="background-color:#45eeff;" class="text-center"><?php echo ucfirst($row3['criteria']);?></th> 
							 <?php endwhile; ?> 
								

                                <th style="background-color:#45eeff;"  class="text-center">Finals Total </th>
                                <th style="background-color:#45eeff;"  class="text-center">Finals EQ. </th>
                                <th style="background-color:#ff454580;"  class="text-center">Total</th>
                                <th style="background-color:#ff454580;"   class="text-center">Total EQ.</th>
                                <th class="text-center">REMARKS</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $c=1; ?>
                    <?php foreach($mystudent as $row): ?>
						<?php 
					
	$criterialistmidterm = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialistfinals = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']);  
					?>
                        <tr>
                            <td class="text-left"><?php echo $c; ?></td>       
                            <td class="text-center"><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname']; ?></td>  
                            <?php $grade = $student->getstudentgrade($row['id'],$classid); ?>
							
							<!--
                            <td class="text-center"><?php echo $grade['prelim'];?></td>    
							-->
							<?php while($row3 = mysql_fetch_array($criterialistmidterm)): ?> 
                              <td  class="text-center"><?php echo number_format($grade['midterm_'.$row3['criteria']],2);?></td> 
							 <?php endwhile; ?>   
                            <td class="text-center"><?php echo $grade['midterm'];?></td>  
  <td   class="text-center"><?php   $meow=$grade['eqmidterm']; if($meow>3){echo "<label  style='color:red;' >$meow</label>"; }else{echo "<label  style='color:green;' >$meow</label>"; } ?></td>  
														
								  <?php while($row3 = mysql_fetch_array($criterialistfinals)): ?> 
                              <td  class="text-center"><?php echo number_format($grade['finals_'.$row3['criteria']],2);?></td> 
							 <?php endwhile; ?>  
							 
                            <td class="text-center"><?php echo $grade['final'];?></td>   
                            <td class="text-center"><?php $meow=$grade['eqfinal']; if($meow>3){echo "<label  style='color:red;' >$meow</label>"; }else{echo "<label  style='color:green;' >$meow</label>"; } ?></td>    
                            <td class="text-center"><?php echo $grade['total'];?></td>                                
                            <td   class="text-center"><strong><?php $meow=$grade['eqtotal']; if($meow>3){echo "<label  style='color:red;' >$meow</label>"; }else{echo "<label  style='color:green;' >$meow</label>"; }  ?></strong></td>    
                            <?php
                                if($grade['eqtotal']>=1.0 && $grade['eqtotal']<=3.0){
                                    $remarks = 'PASSED';
                                    $class = 'text-success';
                                }else{
                                    $remarks = 'FAILED';
                                    $class = 'text-danger';   
                                }
                            ?>
                            <td class="text-center <?php echo $class;?>"><?php echo $remarks;?></td> 
                        </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>
                    <?php if(!$mystudent): ?>
                        <tr><td colspan="8" class="text-center text-danger">*** No Result ***</td></tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div> 
</body>
<script src="jquery.min.js" type="text/javascript"></script>

<script>

   var tablesToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , tmplWorkbookXML = '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
      + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Clarence Andaya </Author><Created>{created}</Created></DocumentProperties>'
      + '<Styles>'
      + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
      + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
      + '</Styles>' 
      + '{worksheets}</Workbook>'
    , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
    , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(tables, wsnames, wbname, appname) {
		
		 var dateN = unescape("<?=rawurlencode(date('m-d-Y'))?>");
			  var sectionN = unescape('<?=rawurlencode($sectionN)?>');
			  var subjectN = unescape('<?=rawurlencode($subjectN)?>');
			   var wbname = dateN+" "+sectionN+" "+subjectN+".xls";
      var ctx = "";
      var workbookXML = "";
      var worksheetsXML = "";
      var rowsXML = "";

      for (var i = 0; i < tables.length; i++) {
        if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
        for (var j = 0; j < tables[i].rows.length; j++) {
          rowsXML += '<Row>'
          for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
            var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
            var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
            var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
            dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
            var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
            dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
            ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                   , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                   , data: (dataFormula)?'':dataValue
                   , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                  };
            rowsXML += format(tmplCellXML, ctx);
          }
          rowsXML += '</Row>'
        }
        ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
        worksheetsXML += format(tmplWorksheetXML, ctx);
        rowsXML = "";
      }

      ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
      workbookXML = format(tmplWorkbookXML, ctx);

console.log(workbookXML);

      var link = document.createElement("A");
      link.href = uri + base64(workbookXML);
      link.download = wbname || 'ClassRecord.xls';
      link.target = '_blank';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  })();
</script>

</html>