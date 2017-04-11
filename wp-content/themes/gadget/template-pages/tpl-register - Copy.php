<?php
/*
Template Name: Register
 */
get_header();
get_template_part( 'template-parts/template-part', 'head' );
?>
<form enctype="multipart/form-data" class="general-form register-frame js-scroll-section" action="" method="POST" name="registration_form" id="registration_form">
	<div class="container">
		<div class="row">
     <!--  <div class="facebook-block text-center"> 
        <a href="javascript:void(0)" onClick="fbLogin()" class="facebook-btn"><span class="icon-facebook"></span><?php esc_html_e( ' Sign in with Facebook','sale-my-gadget');?></a>
                   <header class="alter-heading"> <span class="text">or</span> </header>
                 </div> -->
			<div class="col-xs-12 col-lg-8 col-lg-offset-2">
				<div class="col-xs-12 col-sm-6">
					
					<div class="form-group">
						<input placeholder="First Name" name="fname" id="fname" type="text" class="form-control">
					</div>
					<div class="form-group">
						<input placeholder="Last Name" name="lname" id="lname" type="text" class="form-control">
					</div>
					<div class="form-group">
						<input placeholder="Email" type="email" id="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<input placeholder="Username" type="text" id="username" name="username" class="form-control">
					</div>
					<div class="form-group">
						<input placeholder="Password" name="password" id="password" type="password" class="form-control">
					</div>
					<div class="form-group">
						<input placeholder="Confirm Password" name="cpassword" id="cpassword" type="password" class="form-control">
					</div>
					<div class="form-group employee-field">
						<input placeholder="Mobile" name="mobile" id="mobile" type="text" class="form-control">
					</div>					
					<div class="form-group employee-field">
						<input type="file" name="profile_image" onchange="readURL(this,'#pp_image');" id="profile_image" >
						<span class="size-limit">
							<?php esc_html_e( 'Profile Picture (size less than 2mb)','sale-my-gadget');?>
						</span>
						<img src="<?php echo esc_url($profile_image);?>" alt="Profile Image" id="pp_image">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					
					<div id="locationField" class="form-group">
						<input id="address" placeholder="Enter your address" onFocus="geolocate()" type="text" class="form-control" name="address"></input>
					</div>


         		<div>
         			<div class="form-group">
         				<select class="form-control" name="city" id="city">
         					<option selected="selected" value="">Choose your city</option>

         					<option value="71">Achham</option>


         					<option value="72">Arghakhachi</option>


         					<option value="73">Baglung</option>


         					<option value="74">Baitadi</option>


         					<option value="75">Bajura</option>


         					<option value="95">Banepa</option>


         					<option value="76">Banke</option>


         					<option value="77">Bara</option>


         					<option value="78">Bardiya</option>


         					<option value="70">Bhaktapur</option>


         					<option value="79">Bhojpur</option>


         					<option value="80">Chitwan</option>


         					<option value="81">Dadeldhura</option>


         					<option value="82">Dailekh</option>


         					<option value="24">Dang</option>


         					<option value="83">Darchula</option>


         					<option value="26">Dhading</option>


         					<option value="27">Dhankuta</option>


         					<option value="28">Dhanusa</option>


         					<option value="29">Dolakha</option>


         					<option value="84">Dolpa</option>


         					<option value="32">Gorkha</option>


         					<option value="33">Gulmi</option>


         					<option value="96">Hetauda</option>


         					<option value="85">Humla</option>


         					<option value="35">Illam</option>


         					<option value="86">Jajarkot</option>


         					<option value="37">Jhapa</option>


         					<option value="87">Jumla</option>


         					<option value="38">Kailali</option>


         					<option value="39">Kanchanpur</option>


         					<option value="40">Kapilbastu</option>


         					<option value="88">Kaski</option>


         					<option value="2">Kathmandu</option>


         					<option value="41">Khotang</option>


         					<option value="98">Kirtipur</option>


         					<option value="42">Lamjung</option>


         					<option value="43">Mahottari</option>


         					<option value="44">Morang</option>


         					<option value="45">Myagdi</option>


         					<option value="46">Nawalparasi</option>


         					<option value="47">Nuwakot</option>


         					<option value="48">Okhaldhunga</option>


         					<option value="89">Pachthar</option>


         					<option value="49">Palpa</option>


         					<option value="50">Parbat</option>


         					<option value="51">Parsa</option>


         					<option value="97">Patan</option>


         					<option value="52">Pyuthan</option>


         					<option value="90">Ramechhap</option>


         					<option value="91">Rasuwa</option>


         					<option value="53">Rautahat</option>


         					<option value="54">Rolpa</option>


         					<option value="55">Rukum</option>


         					<option value="56">Rupandehi</option>


         					<option value="57">Salyan</option>


         					<option value="92">Salyang</option>


         					<option value="58">Sankhuwasabha</option>


         					<option value="59">Saptari</option>


         					<option value="60">Sarlahi</option>


         					<option value="61">Sindhuli</option>


         					<option value="93">Sindhulki</option>


         					<option value="62">Sindhupalchowk</option>


         					<option value="63">Siraha</option>


         					<option value="64">Sunsari</option>


         					<option value="65">Surkhet</option>


         					<option value="66">Syangja</option>


         					<option value="67">Tanahu</option>


         					<option value="68">Taplejung</option>


         					<option value="69">Terathum</option>


         					<option value="94">Udaypur</option>


         				</select>

         			</div>
         		</div>			
         	</div>
         	<div class="col-xs-12">
         		<div class="btn-group">
                  <div class="g-recaptcha" data-sitekey="6LfROxsUAAAAANCsb8tNYtwYtl_RyVAYagAEcXy5" data-callback="recaptchaCallback"></div>
                  <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
         			<input type="submit" value="Submit" id="registerSubmit" class="btn btn-default">
         			<div id="loader"></div>
         		</div>
         		<div class="success_message" style="display: none;">
         		</div>
         	</div>
         </div>
     </div>
 </div>
</form>
<?php 
get_footer();?>