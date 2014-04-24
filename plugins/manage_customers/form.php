
<div class="wrap">
     <?php    echo "<h2>" . __( 'Add Customer  ') . "</h2>"; ?>
 <form method="post" id="userForm" enctype="multipart/form-data" action="">

<table border="0">

	<tr>
		<td>Customer Name (*)</td>
		<td><input type="text" value="" size="30"  name="form[Customer Name]" id="Customer Name" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Last 5 Numbers of Social Security # (*)</td>
		<td><input type="text" value="" size="5"  name="form[Last 5 Numbers of Social ]" id="Last 5 Numbers of Social " /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Customer File #</td>
		<td><input type="text" value="" size="20"  name="form[Customer File Number]" id="Customer File Number" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Customer Email (*)</td>
		<td><input type="text" value="" size="30"  name="form[Customer Email]" id="Customer Email" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td><font size="3" color="brown">BUYERS REALTOR</font><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td>Select Realtor</td>
		<td><select  name="form[Select Realtor][]"  id="Select Realtor"  ><option  value="SELECT REALTOR">SELECT REALTOR</option><option  value="Andy Furr - Keller Williams - 251-377-3335 - andyfurr.kw@gmail.com">Andy Furr - Keller Williams - 251-377-3335 - andyfurr.kw@gmail.com</option><option  value="Angela Perry - Coldwell Banker United - 251-510-3246 - angela.perry@cbunited.com">Angela Perry - Coldwell Banker United - 251-510-3246 - angela.perry@cbunited.com</option><option  value="Asa Goode - Carney Realty - (C) (251) 233-2132 - Asa@TheGulfDream.com">Asa Goode - Carney Realty - (C) (251) 233-2132 - Asa@TheGulfDream.com</option><option  value="Brian Winkler - Gulf Realty - (C) (251)979-5026 - brian.winkler@yahoo.com">Brian Winkler - Gulf Realty - (C) (251)979-5026 - brian.winkler@yahoo.com</option><option  value="Bruce Alexander - Realty 1st - bruceatthebeach@gmail.com - 251-609-0670">Bruce Alexander - Realty 1st - bruceatthebeach@gmail.com - 251-609-0670</option><option  value="Donnie Manning - Remax Realty Centre - (C) (251) 689-6308 - donniemanning@remax.net">Donnie Manning - Remax Realty Centre - (C) (251) 689-6308 - donniemanning@remax.net</option><option  value="Helen Whealton - Kaiser Realty - 251-752-4206 - helenw@kaiserrealty.com">Helen Whealton - Kaiser Realty - 251-752-4206 - helenw@kaiserrealty.com</option><option  value="JJ Culmone - Waterways Realty - jjmack62@yahoo.com - (251) 752-3116">JJ Culmone - Waterways Realty - jjmack62@yahoo.com - (251) 752-3116</option><option  value="Linda Tedder - ReMax of Gulf Shores - ltedder@gulftel.com - 251-948-7512">Linda Tedder - ReMax of Gulf Shores - ltedder@gulftel.com - 251-948-7512</option><option  value="Susan Trawick - Atlas Group - (C)(251) 458-4834 - susan.trawick@gmail.com">Susan Trawick - Atlas Group - (C)(251) 458-4834 - susan.trawick@gmail.com</option><option  value="Tammy Godbold - Waterways Realty - (C) (251) 609-5403 - tammyg@gulftel.com">Tammy Godbold - Waterways Realty - (C) (251) 609-5403 - tammyg@gulftel.com</option><option  value="Tom Russ - Century 21 Meyer - 251-752-5142 - truss@meyerre.com">Tom Russ - Century 21 Meyer - 251-752-5142 - truss@meyerre.com</option><option  value=""></option></select><div class="formClr"></div> </td>
		<td>See if Realtor is Listed Here:</td>
	</tr>
	<tr>
		<td>Realtor Name</td>
		<td><input type="text" value="" size="30"  name="form[Realtor Name]" id="Realtor Name" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Real Estate Company</td>
		<td><input type="text" value="" size="30"  name="form[Real Estate Company]" id="Real Estate Company" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Realtors Email</td>
		<td><input type="text" value="" size="30"  name="form[Realtors Email]" id="Realtors Email" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Realtors Phone</td>
		<td><input type="text" value="" size="20"  name="form[Realtors Phone]" id="Realtors Phone" /><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td><font size="3" color="brown">SELLERS REALTOR</font><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td>Sellers Realtor</td>
		<td><input type="text" value="" size="30"  name="form[Sellers Realtor Name]" id="Sellers Realtor Name" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Sellers Realtor Company</td>
		<td><input type="text" value="" size="30"  name="form[Sellers Realtor Company]" id="Sellers Realtor Company" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Sellers Realtor Email</td>
		<td><input type="text" value="" size="30"  name="form[Sellers Realtor Email]" id="Sellers Realtor Email" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Sellers Realtor Phone</td>
		<td><input type="text" value="" size="30"  name="form[Sellers Realtor Phone]" id="Sellers Realtor Phone" /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td><font size="3" color="brown">LENDER</font><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td>Lender Name</td>
		<td><input type="text" value="" size="30"  name="form[Lender Name]" id="Lender Name" /><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td>Lending Agent</td>
		<td><input type="text" value="" size="30"  name="form[Lending Agent]" id="Lending Agent" /><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td>Lender Phone</td>
		<td><input type="text" value="" size="20"  name="form[Lender Phone ]" id="Lender Phone " /><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Lender Email</td>
		<td><input type="text" value="" size="30"  name="form[Lender Email]" id="Lender Email" /><div class="formClr"></div></td>
		<td></td>
	</tr>
	<tr>
		<td>Closing Date</td>
		<td><input id="txtcal0" name="form[Closing Date]" type="text"   value="" /><input id="btn0" type="button" value="..." onclick="showHideCalendar('cal0Container');" class="btnCal"  /><div al0Container" style="clear:both;display:none;position:absolute;z-index:9977"></div><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Closing Office (*)</td>
		<td><input  name="form[Closing Office][]" type="checkbox" value="Orange Beach, AL" id="Closing Office0"  /><label for="Closing Office0">Orange Beach, AL</label><input  name="form[Closing Office][]" type="checkbox" value="Mobile, AL" id="Closing Office1"  /><label for="Closing Office1">Mobile, AL</label><div class="formClr"></div> </td>
		<td></td>
	</tr>
	<tr>
		<td>Submit</td>
		<td><input type="submit" value="Send Information to Title Doc Access" name="form[Submit]" id="Submit"  /><div class="formClr"></div></td>
		<td></td>
	</tr>
</table>
<input type="hidden" name="form[formId]" value="3"/></form>
</div>
<?


        $dbemail = $_POST['email'];
        update_option('host', $dbemail);
         
        $dbname = $_POST['name'];
        update_option('name', $dbname);
         
         $dbuser = $_POST['user'];
        update_option('user', $dbuser);
         
        $dbpwd = $_POST['pwd'];
        update_option('pwd', $dbpwd);
 
       // $prod_img_folder = $_POST['oscimp_prod_img_folder'];
        //update_option('oscimp_prod_img_folder', $prod_img_folder);
 
       // $store_url = $_POST['oscimp_store_url'];
       // update_option('oscimp_store_url', $store_url);
        
		
		
	
      // you should do the validation before save data in db.
      // I will not write the validation function, is out of scope of this answer
      //$pass_validation = validate_user_data($_POST);
      if ( 1==1 ) {
        $data = array(
          'email' => $dbemail,
          'name' => $dbname,
          'user' => $dbuser,
		  'pass' => $dbpwd  
        );
        global $wpdb;
        // if you have followed my suggestion to name your table using wordpress prefix
        $table_name = $wpdb->prefix . 'customers';
		
		 
		//die('sad') ; 
        // next line will insert the data
         // $res = $wpdb->insert($table_name, $data, '%s'); 
       
		
		// if you want to retrieve the ID value for the just inserted row use
         $rowid = $wpdb->insert_id;
        // after we insert we have to redirect user
        // I sugest you to cretae another page and title it "Thank You"
        // if you do so:
        //$redirect_page = get_page_by_title('Thank You') ? : get_queried_object();
        // previous line if page titled 'Thank You' is not found set the current page
        // as the redirection page. Next line get the url of redirect page:
        //$redirect_url = get_permalink( $redirect_page );
        // now redirect
        //wp_safe_redirect( $redirect_url );
        // and stop php
        //exit();
    
//$email = $wpdb->query("SELECT email FROM wp_customers") ; 


$emails = $wpdb->get_results( "SELECT email FROM wp_customers" );
      
		
		foreach($emails as $email)
		{
		   $email = $email->email ; 
		   $subject= "mail from adeel" ; 
		   $user = $wpdb->get_results( "SELECT user FROM wp_customers WHERE email=\"$email\" " );  
		   $message= "Welcome  "  .$user->user.  "   "; 
		    
		  $res = wp_mail( $email, $subject, $message); 
		
		}
		


	}
   



		
		
		
		
		
		
		
		
		
		
		
		
		
     //<div class="updated"><p><strong><?php _e('Options saved.' ); </strong></p></div>  // 
 
	?>