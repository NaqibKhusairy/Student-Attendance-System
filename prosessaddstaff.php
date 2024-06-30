<html>
	<head>
		<title>Add Staff - Student Attendance Data System</title>
	</head>
	<body>
		<?php
            include('db/conection.php');
			function IctoAnything($ic)
			{
				if($ic%2==0)
				{
					$gender="Female";
				}
				else
				{
					$gender="Male";
				}
				$year=substr($ic,0,2);
				if($year >=0 && $year <=23)
				{
					$year+=2000;
				}
				else{
					$year+=1900;
				}
				$age=date("Y")-$year;
				$month=substr($ic,2,2);
				$day=substr($ic,4,2);
				$DOB="$day-$month-$year";
				$from =substr($ic, 6, 2);
				if ($from==1||$from==21||$from==22||$from==23||$from==24) 
				{
					$negeri="Johor";
				}
				elseif ($from==2||$from==25||$from==26||$from==27) 
				{
					$negeri="Kedah";
				}
				elseif ($from==3||$from==28||$from==29) 
				{
					$negeri="Kelantan";
				} 
				elseif ($from==4||$from==30) 
				{
					$negeri="Melaka";
				} 
				elseif ($from==5||$from==31||$from==59) 
				{
					$negeri="Negeri Sembilan";
				} 
				elseif ($from==6||$from==32||$from==33) 
				{
					$negeri="Pahang";
				} 
				elseif ($from==7||$from==34||$from==35) 
				{
					$negeri="Pulau Pinang";
				} 
				elseif ($from==8||$from==36||$from==37||$from==38||$from==39) 
				{
					$negeri="Perak";
				} 
				elseif ($from==9||$from==40) 
				{
					$negeri="Perlis";
				} 
				elseif ($from==10||$from==41||$from==42||$from==43||$from==44) 
				{
					$negeri="Selangor";
				} 
				elseif ($from==11||$from==45||$from==46) {
					$negeri="Terengganu";
				} 
				elseif ($from==12||$from==47||$from==48||$from==49) 
				{
					$negeri="Sabah";
				} 
				elseif ($from==13||$from==50||$from==51||$from==52||$from==53) 
				{
					$negeri="Sarawak";
				} 
				elseif ($from==14||$from==54||$from==55||$from==56||$from==57) 
				{
					$negeri="Kuala Lumpur";
				} 
				elseif ($from==15||$from==58) 
				{
					$negeri="Labuan";
				} 
				elseif ($from==16) 
				{
					$negeri="Putrajaya";
				} 
				else 
				{
					$negeri="Negeri Tidak Diketahui";
				}
				return [$gender,$negeri,$DOB,$age];
			}
            $name = $_POST["name"];
            $id = $_POST["id"];
            $ic = $_POST["ic"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $race = $_POST["race"];
            $addrss = $_POST["addrss"];
			$result=IctoAnything($ic);
			$gender=$result[0];
			$negeri=$result[1];
			$DOB=$result[2];
			$age=$result[3];
		?>
		<form name="form" method="post" action="addstaffdb.php">
            <table id="indextable">
                <tr>
                    <td colspan="3">
                        <br>
                        <center>
                            <h1>
                                CONFIRMATION STAFF
                            </h1>
                        </center>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Name 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="name" required value="<?php echo $name;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff ID 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="id" required placeholder="Staff ID" value="<?php echo $id;?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff IC 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="ic" pattern="[0-9]{12}" required value="<?php echo $ic;?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Date Of Birth 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="dob" value="<?php echo $DOB;?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Age 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="age" value="<?php echo $age;?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Gender 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="gender" value="<?php echo $gender;?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff State Of Birth 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="sob" value="<?php echo $negeri;?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Phone Number 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $phone;?>" pattern="[0-9]{3}-[0-9]{7,8}" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Email 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="email" name="email" required value="<?php echo $email;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Race 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <select name="race" required>
                            <option value="" <?php if ($race == '') echo 'selected'; ?>>Select Race</option>
                            <option value="Malay" <?php if ($race == 'Malay') echo 'selected'; ?>>Malay</option>
                            <option value="Chinese" <?php if ($race == 'Chinese') echo 'selected'; ?>>Chinese</option>
                            <option value="Indian" <?php if ($race == 'Indian') echo 'selected'; ?>>Indian</option>
                            <option value="Others" <?php if ($race == 'Others') echo 'selected'; ?>>Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Staff Address 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <textarea name="addrss" placeholder="address" required style="width: 170px; height: 113px;"><?php echo $addrss;?></textarea>
                    </td>
                </tr>
                    <tr>
                        <td colspan="3">
                            <center><button type="submit" class="resultButton">CONFIRM</button></center>
                        </td>
                    </tr>
            </table>
        </form>
	</body>
</html>