<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>


  <style type="text/css">
  		body{
  			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  		}

  		.logo{

  			margin-right: 20px;
  			width: 120px;
  		}

      .qr-code{
        width: 120px;
      }

  		.width-full{

  			/*width: 216mm;*/
  			margin-top: 10px;
  			font-size: 12px;
  			height: auto;
  		}

  		.box{
  			width: 20px;
  			height: 20px;
  			border: 1px solid #000000;
  			margin-left: -1px;
  			text-align: center;
  			float: left;
  			display: block;
  			margin-bottom: 2px;
  			line-height: 20px;
  		}


  		#marks{

  			font-size: 12px;
  			border-collapse: collapse;
  			width: 100%;
  		}

  		#marks td, #marks th {
  		    border: 1px solid #000000;
  		    padding: 6px 3px 6px 3px;
  		    text-align: center;
  		}

  		.photo{

  			width: 100%;
  			height: 100%;
  			border: 1px solid black;
  			text-align: left;
  		}

  		#basic{

  			border-collapse: collapse;
  			width: 100%;
  			font-size: 12px;
  		}


  		#basic td, #basic th {
  		    border: 1px solid #000000;
  		    padding: 6px 3px 6px 3px;
  		    /*width: 25%;*/
  		}

  		#photo{

  			width: 35mm;
  			height: 45mm;
  			border: 1px solid #000000;
  			position: absolute;
  			right: 18mm;
  			top: 60mm;
  			border-radius: 10px;
  		}

  		#under-photo{

  			width: 35mm;
  			height: 20mm;
  			border: 1px solid #000000;
  			position: absolute;
  			right: 18mm;
  			top: 110mm;
  			border-radius: 10px;
  		}

  		#fields{

  			font-size: 12px;
  		}

  		#fields td{

  			padding-top: 5px;
  			padding-bottom: 5px;
  		}

  		#subjects{

  			width: 85%; 
  			margin-top: 10px;
  		}

  		#subjects td{

  			height: 25px;
  			font-size: 12px;
  		}

  		li{
  			font-size: 12px;
  		}
  		
  		#signature{
  			float:right;
  			font-size: 12px;

  		}

	
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
	<section class="sheet padding-10mm watermark">

		<table style="width: 100%;">
	      <tr>
	        <td style="width: 15%" rowspan="4">
            @if($data->user->profile_picture)
              <img class="logo" src="uploads/candidates_images/{{ $data->user->profile_picture }}">
            @else
              <img class="logo" src="assets/img/avatar.jpg">
            @endif

	        </td>
	        <td style="width: 85%;">
	        	<p style="margin: 0px;">
	        		{{ $data->timeslot->exam_calander->exam->exam_title }}
	        		<br>
	        		<small>ROLL NUMBER SLIP (FOR STUDENT)</small>
	        	</p>
	        	<p style="font-size: 12px;">
	        		{{ $data->user->name }} S/O {{ $data->user->father_name }} | Reg-{{ $data->reg_number }} 
	        	</p>
	        	<p style="font-size: 12px;"><strong>{{ $data->timeslot->exam_calander->exam_center->name }}</strong></p>
	        	<p style="font-size: 12px;"><strong>{{ $data->timeslot->exam_calander->exam_center->address }}</strong></p>
	        </td>
	        <td style="width: 15%" rowspan="4">
	          <!-- <img class="qr-code" src="assets/img/qrcode.jpg"> -->
            {!! QrCode::size(120)->generate($data->reg_number) !!}
	        </td>
	      </tr>
		  <tr>

		  </tr>
	    </table>

	    <br>	    
	    <table id="basic">
	    	<tr>
	    		<th align="center" style="width: 130px">Exam Type</th>
	    		<th align="center" style="width: 150px">Test Date</th>
	    		<th align="center" style="width: 150px">Timing</th>
	    		<th align="center" style="width: 200px">Venue</th>
	    	</tr>
	    	<tr>
	    		<td align="center">{{ $data->timeslot->exam_calander->exam->exam_title }}</td>
	    		<td align="center">{{ $data->timeslot->exam_calander->exam_date->format('d-m-Y') }}</td>
	    		<td align="center">{{ $data->timeslot->time_from }}</td>
	    		<td align="center">{{ $data->timeslot->exam_calander->exam_center->name }}</td>
	    	</tr>
	    
	    </table>
	   	<p style="font-size: 12px;">
	    	<strong>Note:</strong> <br/>
	    	<ul>

          <li>Keep the slip safe</li>
          <li>Candidates are required to bring it to the exam center and keep it with them at all times </li>
          <li>The candidates must reach their respective centers at least an hour before the exam</li>
          <li>Exam Center will close 10 minutes before start of the examination</li>
          <li>Mobile phones, smartwatches and other electronic gadgets are NOT allowed in the examination hall otherwise strict disciplinary action shall be taken which may also lead to cancellation of paper and will be debarred from appearing in the upcoming MDCAT Exam</li>
          <li>Strict disciplinary action shall be taken against candidates found creating noise and distraction in or around the exam center. It may lead to cancellation of paper or debarring from the examination</li>

	    	</ul>
    	</p>
    	
    	<table id="signature">
    	<tr><td style="text-align:center;"></td></tr>
		<tr><td><strong>Examination Officer <br/>PMC-ES Examination Department</strong></td></tr>
   	</table>
	 <hr/>

   <table style="width: 100%">
     <tr>
       <td style="width: 80%">
         <table>
           <tr>
            <td><strong>Username:</strong> {{ $data->reg_number }}</td>
           </tr>
           <tr>
            <td><strong>Password:</strong> {{ $data->exam_password }}</td>
           </tr>
         </table>
       </td>
       <td>
         <h3>Seat No. : {{ $data->seat_no }}</h3>
       </td>
     </tr>
   </table>

   
	
	    
	</section>

</body>

</html>


