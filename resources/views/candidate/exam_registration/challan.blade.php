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

  			width: 15mm;
  			border: 1px soli/*d*/ black;
  			text-align: left;
        margin: 10px;
  		}

  		.basic{

  			border-collapse: collapse;
  			width: 100%;
  			font-size: 12px;
  		}


  		.basic td, .basic th {
  		    border: 1px solid #000000;
  		    padding: 6px 3px 6px 3px;
  		    /*width: 25%;*/
  		}

  		#photo{

  			width: 35mm;
  			height: 45mm;
  			/*border: 1px solid #000000;*/
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

      hr{
          border-top: 1px dashed black;
      }

      .challan-no{
        text-align: right;
      }

      .challan-no p{
        font-size: : 12px;
      }

	
  </style>
</head>

<body class="A4">

  <table style="width: 100%;">
    <tr>
      <td>
        <table>
          <tr>
            <td style="width: 10%">
              <img class="photo" src="assets/img/pmslogo.png">
            </td>
            <td>
              <h3>PMC Examination <br>Challan Form</h3>
            </td>
            <td class="challan-no">
              <p>Challan No. : 000001245</p>
            </td>
          </tr>
        </table>
        <table class="basic">
          <tr>
            <td style="width: 30%">Full Name</td>
            <td>{{ $data->user->name }}</td>
          </tr>
          <tr>
            <td style="width: 30%">Father Name</td>
            <td>{{ $data->user->father_name }}</td>
          </tr>
          <tr>
            <td style="width: 30%">CNIC Number</td>
            <td>{{ $data->user->cnic_number }}</td>
          </tr>
        </table>
        <table class="basic">
          <tr>
            <td style="width: 30%">Account Number</td>
            <td>123123123</td>
          </tr>
          <tr>
            <td style="width: 30%">Account Title</td>
            <td>Demo Account Title</td>
          </tr>
          <tr>
            <td style="width: 30%">Amount</td>
            <td>6000</td>
          </tr>
          <tr>
            <td style="width: 30%">Due Date</td>
            <td>20-12-2022</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <hr/>
      </td>
    </tr>
    <tr>
      <td>
        <table>
          <tr>
            <td style="width: 10%">
              <img class="photo" src="assets/img/pmslogo.png">
            </td>
            <td>
              <h3>PMC Examination <br>Challan Form</h3>
            </td>
            <td class="challan-no">
              <p>Challan No. : 000001245</p>
            </td>
          </tr>
        </table>
        <table class="basic">
          <tr>
            <td style="width: 30%">Full Name</td>
            <td>{{ $data->user->name }}</td>
          </tr>
          <tr>
            <td style="width: 30%">Father Name</td>
            <td>{{ $data->user->father_name }}</td>
          </tr>
          <tr>
            <td style="width: 30%">CNIC Number</td>
            <td>{{ $data->user->cnic_number }}</td>
          </tr>
        </table>
        <table class="basic">
          <tr>
            <td style="width: 30%">Account Number</td>
            <td>123123123</td>
          </tr>
          <tr>
            <td style="width: 30%">Account Title</td>
            <td>Demo Account Title</td>
          </tr>
          <tr>
            <td style="width: 30%">Amount</td>
            <td>6000</td>
          </tr>
          <tr>
            <td style="width: 30%">Due Date</td>
            <td>20-12-2022</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <hr/>
      </td>
    </tr>
    <tr>
      <td>
        <table>
          <tr>
            <td style="width: 10%">
              <img class="photo" src="assets/img/pmslogo.png">
            </td>
            <td>
              <h3>PMC Examination <br>Challan Form</h3>
            </td>
            <td class="challan-no">
              <p>Challan No. : 000001245</p>
            </td>
          </tr>
        </table>
        <table class="basic">
          <tr>
            <td style="width: 30%">Full Name</td>
            <td>{{ $data->user->name }}</td>
          </tr>
          <tr>
            <td style="width: 30%">Father Name</td>
            <td>{{ $data->user->father_name }}</td>
          </tr>
          <tr>
            <td style="width: 30%">CNIC Number</td>
            <td>{{ $data->user->cnic_number }}</td>
          </tr>
        </table>
        <table class="basic">
          <tr>
            <td style="width: 30%">Account Number</td>
            <td>123123123</td>
          </tr>
          <tr>
            <td style="width: 30%">Account Title</td>
            <td>Demo Account Title</td>
          </tr>
          <tr>
            <td style="width: 30%">Amount</td>
            <td>6000</td>
          </tr>
          <tr>
            <td style="width: 30%">Due Date</td>
            <td>20-12-2022</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
      
    
</body>

</html>


