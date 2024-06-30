<html>
	<head>
		<title>Add Student - Student Attendance Data System</title>
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
            $pname = $_POST["pname"];
            $pphone = $_POST["pphone"];
            $name = $_POST["name"];
            $id = $_POST["id"];
            $ic = $_POST["ic"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $race = $_POST["race"];
            $pincome = $_POST["pincome"];
            $addrss = $_POST["addrss"];
			$result=IctoAnything($ic);
			$gender=$result[0];
			$negeri=$result[1];
			$DOB=$result[2];
			$age=$result[3];
		?>
        <form name="form" method="post" action="addstudentdb.php">
            <table id="indextable">
                <tr>
                    <td colspan="3">
                        <br>
                        <center>
                            <h1>
                                CONFIRMATION STUDENT
                            </h1>
                        </center>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Name 
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
                        Student ID 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="id" required placeholder="Student ID" value="<?php echo $id;?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student IC 
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
                        Student Date Of Birth 
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
                        Student Age 
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
                        Student Gender 
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
                        Student State Of Birth 
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
                        Student Phone Number 
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
                        Student Email 
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
                        Student Race 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <select name="race" required>
                            <option value="">Select Race</option>
                            <option value="Malay" <?php if ($race == 'Malay') echo 'selected'; ?>>Malay</option>
                            <option value="Chinese" <?php if ($race == 'Chinese') echo 'selected'; ?>>Chinese</option>
                            <option value="Indian" <?php if ($race == 'Indian') echo 'selected'; ?>>Indian</option>
                            <option value="Others" <?php if ($race == 'Others') echo 'selected'; ?>>Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Address 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                    <textarea name="addrss" placeholder="address" required style="width: 170px; height: 113px;"><?php echo $addrss;?></textarea
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Parent Name 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                    <input type="text" name="pname" required value="<?php echo $pname;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Parent Phone Number 
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <input type="text" name="pphone" value="<?php echo $pphone;?>" pattern="[0-9]{3}-[0-9]{7,8}" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Student Parent Income
                    </td>
                    <td>
                        : 
                    </td>
                    <td>
                        <select name="pincome" required>
                            <option value="" <?php if ($pincome == '') echo 'selected'; ?>>Select Parent Income</option>
                            <option value="0-1000" <?php if ($pincome == '0-1000') echo 'selected'; ?>>RM 0 - RM 1000</option>
                            <option value="1000-1500" <?php if ($pincome == '1000-1500') echo 'selected'; ?>>RM 1001 - RM 1500</option>
                            <option value="1501-2000" <?php if ($pincome == '1501-2000') echo 'selected'; ?>>RM 1501 - RM 2000</option>
                            <option value="2001-2500" <?php if ($pincome == '2001-2500') echo 'selected'; ?>>RM 2001 - RM 2500</option>
                            <option value="2501-3000" <?php if ($pincome == '2501-3000') echo 'selected'; ?>>RM 2501 - RM 3000</option>
                            <option value="3001-3500" <?php if ($pincome == '3001-3500') echo 'selected'; ?>>RM 3001 - RM 3500</option>
                            <option value="3501-4000" <?php if ($pincome == '3501-4000') echo 'selected'; ?>>RM 5501 - RM 4000</option>
                            <option value="4001-4500" <?php if ($pincome == '4001-4500') echo 'selected'; ?>>RM 4001 - RM 4500</option>
                            <option value="4501-5000" <?php if ($pincome == '4501-5000') echo 'selected'; ?>>RM 4501 - RM5000</option>
                            <option value=">5001" <?php if ($pincome == '>5001') echo 'selected'; ?>> &gt; RM 5001</option>
                        </select>
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