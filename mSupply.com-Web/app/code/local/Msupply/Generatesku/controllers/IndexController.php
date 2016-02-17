<?php

class Msupply_Generatesku_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
	
	public function autoselectAction()
    {
  
		$segmnt = $this->getRequest()->getParam('segmentval'); 
		
		?>
		<?php
		
			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
				$select = $connection->select()
					->from('zaybx_generatesku', array('*'))
                    ->where('segment=?',$segmnt)					
					->group('family');              
				$rowsArray = $connection->fetchAll($select);
		?>
		<select id="family_item" title="Select one" name="family_item">
			<option value="">Select</option>
			
		<?php foreach($rowsArray as $row): ?>
		
                <option value="<?php echo $row['family'] ?>"><?php echo $row['family'] ?></option>	
				
		<?php endforeach; ?> 
		</select>
		
	
	
	<?php	
    }
	
	
	public function autoselectfamilyAction()
    {
  
		$fami = $this->getRequest()->getParam('familyval'); 
		
		?>
		<?php
		
			$connection1 = Mage::getSingleton('core/resource')->getConnection('core_read');
				$select1 = $connection1->select()
					->from('zaybx_generatesku', array('*'))
                    ->where('family=?',$fami)					
					->group('class');              
				$rowsArray1 = $connection1->fetchAll($select1); 
		?>
		<select id="class_item" title="Select one">
			<option  value="">Select</option>
			
		<?php foreach($rowsArray1 as $row1): ?>
		
                <option value="<?php echo $row1['class'] ?>"><?php echo $row1['class'] ?></option>	
				
		<?php endforeach; ?> 
		</select>
	
	
		<?php	
    }
	

	
	public function autoselectclassAction()
    {
  
		$classmy = $this->getRequest()->getParam('classval'); 
		$countsku = $this->getRequest()->getParam('countskuval');
		
		$classmy_upper = strtoupper($classmy);
		
		$classmy_first = str_replace(" - ", " ", $classmy_upper);
		
		$classmy_new = str_replace("/", '', $classmy_first);
		$genrsku =  str_word_count($classmy_new);
		
		if($genrsku == 1)
		{
		
			for ($i = 1; $i <= $countsku; $i++)
			{	
				$result = substr($classmy_new, 0, 4);
				$connection1 = Mage::getSingleton('core/resource')->getConnection('core_read');
				$check1 = "SELECT * FROM zaybx_skutable";
				$whole_table1 = $connection1->fetchAll($check1);
				if($whole_table1)
				{	
				$sql        = "SELECT skutable_id FROM zaybx_skutable ORDER BY skutable_id DESC LIMIT 1";
				$rows       = $connection1->fetchOne($sql);
				}
				
				$connection2 = Mage::getSingleton('core/resource')->getConnection('core_read');
				$check2 = "SELECT * FROM zaybx_skutable";
				$whole_table2 = $connection2->fetchAll($check1);
				if($whole_table2)
				{	
				$sql2        = "SELECT created_sku FROM zaybx_skutable where skutable_id=$rows ";
				$rows2       = $connection2->fetchOne($sql2);
				}
				

				$str2 = substr($rows2, 4);
				
				if(!$rows)
				{
				$suffnumber = 10000001;	
				}
				else
				{
				$suffnumber = $str2+1;	
				}
				
				echo $finalsku = $result . $suffnumber;
				echo '<br>';
				$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
	 
				$connection->beginTransaction();
				$__fields = array();
				$__fields['created_sku'] = $finalsku;
				$connection->insert('zaybx_skutable', $__fields);
				$connection->commit();
			}
			
		}
		else
		{
			
			for ($i = 1; $i <= $countsku; $i++)
			{
				
				$name = $classmy_new;
				$name_array = explode(' ', $name);
				$first_word = $name_array[0];
				$second_word = $name_array[1];
				
				$first_word_selected = substr($first_word, 0, 3);
				$second_word_selected = substr($second_word, 0, 1);
				
				$final_word = $first_word_selected . $second_word_selected;
				
				
				$connection1 = Mage::getSingleton('core/resource')->getConnection('core_read');
				$check1 = "SELECT * FROM zaybx_skutable";
				$whole_table1 = $connection1->fetchAll($check1);
				if($whole_table1)
				{	
				$sql        = "SELECT skutable_id FROM zaybx_skutable ORDER BY skutable_id DESC LIMIT 1";
				$rows       = $connection1->fetchOne($sql);
				}
				
				$connection2 = Mage::getSingleton('core/resource')->getConnection('core_read');
				$check2 = "SELECT * FROM zaybx_skutable";
				$whole_table2 = $connection2->fetchAll($check1);
				if($whole_table2)
				{	
				$sql2        = "SELECT created_sku FROM zaybx_skutable where skutable_id=$rows ";
				$rows2       = $connection2->fetchOne($sql2);
				}
			
				$str2 = substr($rows2, 4);
				
				if($rows == 0 || $rows == '')
				{
				$suffnumber = 10000001;	
				}
				else
				{
				$suffnumber = $str2+1;	
				}
				
				echo $finalsku = $final_word . $suffnumber;
				echo '<br>';
					
				$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
	 
				$connection->beginTransaction();
				$__fields = array();
				$__fields['created_sku'] = $finalsku;
				$connection->insert('zaybx_skutable', $__fields);
				$connection->commit();
			}
		}
		?>
		
	
		<?php	
    }
	
	public function autoselectbrickAction()
    {
  
		$classval = $this->getRequest()->getParam('classval'); 
		
		?>
		<?php
		
			$connection3 = Mage::getSingleton('core/resource')->getConnection('core_read');
				$select3 = $connection3->select()
					->from('zaybx_generatesku', array('*'))
                    ->where('class=?',$classval)					
					->group('brick');              
				$rowsArray3 = $connection3->fetchAll($select3);;
		?>
		<select id="brick_item" title="Select one">
			<option  value="">Select</option>
			
		<?php foreach($rowsArray3 as $row3): ?>
		
                <option value="<?php echo $row3['brick'] ?>"><?php echo $row3['brick'] ?></option>	
				
		<?php endforeach; ?> 
		</select>
	
	
		<?php	
    }
	
	public function searchpopupAction()
    {
	  ?>
		<table style="width:100%;">
			<tr>
				<td style="width:50%;">
					<form action="#" id="deliverForm" name="feedForm" type="post" >
					
						<div class="deliver-field">
							<p style="margin-bottom:15px;"><?php echo'Please fill your details below'; ?></p>	
						</div>	
						
						<div class="deliver-field">
								<input type="text" class="input-text cpadin required-entry whitebg"   placeholder=" Your Name* "/ name="name" id="name"> 
								
						</div>
						
						<div class="deliver-field">
								<input type="text" class="input-text cpadin required-entry whitebg font11 required-entry validate-length maximum-length-10 minimum-length-10 validate-digits" placeholder="Mobile No.* "/ name="phone" id="phone">
								<div class="fb-err-phone"></div>
						</div>
						
						<div class="deliver-field">
								<input type="text" class="input-text cpadin required-entry whitebg font11 required-entry validate-email" placeholder="Email Address"/ name="email" id="email"> 
								<div class="fb-err-email"></div>
						</div>
									
						<div class="deliver-field">
								<textarea class="input-text required-entry ctxtar font11 whitebg required-entry" placeholder="Your Query"  cols="10" rows="5" name="comment" id="comment"></textarea> 
								<div class="fb-err-comment"></div>
								
						</div>
				  
					   <div class="deliver-field"> <input type="button" value="Ask NOW" id="deliver-button" class="button feed-button" name="deliver-button" ></div>
					   <div id="interaction_div"></div>
					   
					   
					 </form>
				 </td>
				 
				 <td style="width:50%;">
					<div style="background:#999; padding:55px 5px 5px;height:255px;">
						<p>Hi,</p></br>
						<p>We are currently not able to deliver in your locality.Please share your contact details and we will get back to you.</p></br>
						<p>Please call on +91-7899901156</p>
					</div>
				 </td>
			</tr>
		</table>	 
	  <?php	  
	}
	
}
