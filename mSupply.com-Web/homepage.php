<?php
include_once 'app/Mage.php';
Mage::app();
echo '<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">';
echo '<ul class="category-list orange">';
echo '<li class="default desktop-display"><i class="fa fa-bars"></i></i>Categories</li>';


$children = Mage::getModel('catalog/category')->load(2); 
$_category1 =  $children->getChildrenCategories();

foreach ($_category1 as $category1) {
echo '<li><a class="main-nav" href="JavaScript:void(0)">';
	$cid =  $category1->getId();
	if($cid == 271){
	
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/building.png'.'"'; 
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/building_w.png'.'\'"  ';
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/building.png'.'\'" alt="building"/></div>';
    }
	 if($cid == 272){
	 echo 	'<div class="menu-image">';
      echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/cables.png'.'"'; 
      echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/cables_w.png'.'\'"';  
      echo  'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/cables.png'.'\'" alt="cables"/></div>';
     }
	$cid =  $category1->getId();
	if($cid == 276){
        
echo '<div class="menu-image"> ';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/bricks.png'.'"'; 
  echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/bricks_w.png'.'\'"';  
  echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/bricks.png'.'\'" alt="bricks"/></div>';
    }
	if($cid == 274){
	 
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/paint.png'.'"'; 
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/paint_w.png'.'\'"';  
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/paint.png'.'\'" alt="paint"/></div>';
    }
	$cid =  $category1->getId();
	if($cid == 275){
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/interiors.png'.'"'; 
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/interiors_w.png'.'\'"';  
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/interiors.png'.'\'" alt="interiors"/></div>';
	 
	}
	if($cid == 273){
	 	
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/plumbing.png'.'"';
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/plumbing_w.png'.'\'"';
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/plumbing.png'.'\'" alt="plumbing"/></div>';
	}
    if($cid == 305){
	 	
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/kitchen.png'.'"';
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/kitchen_w.png'.'\'"';
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/kitchen.png'.'\'" alt="Kitchen"/></div>';
	}
    if($cid == 306){
	 	
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/repairs.png'.'"';
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/tools_w.png'.'\'"';
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/repairs.png'.'\'" alt="repairs"/></div>';
	}
	 if($cid == 312){
	 	
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/equipments.png'.'"';
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/equipments_w.png'.'\'"';
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/equipments.png'.'\'" alt="constructionequipment"/></div>';
	}
     if($cid == 314){
	 	
echo '<div class="menu-image">';
echo '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/green.png'.'"';
echo 'onmouseover="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/green_w.png'.'\'"';
echo 'onmouseout="this.src=\''.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/green.png'.'\'" alt="Green Solutions"/></div>';
	}
	echo $category1->getName();
    echo '<span class="fa fa-angle-down mobile-dropdown"></span><span class="fa fa-angle-up mobile-dropdown"></span> <span class="fa fa-angle-right desktop-dropdown"></span></a>
<ul>';
        $catId1 = $category1->getId();
        $children1 = Mage::getModel('catalog/category')->load($catId1); 
        $_category2 =  $children1->getChildrenCategories();
	    foreach ($_category2 as $category2) { 
            echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'">'.$category2->getName().'</a>';
               echo '<ul class="brand-list">';
				
				//Type Start
				   
					$products1 = Mage::getModel('catalog/category')->load($category2->getId())
							    ->getProductCollection()
								->addAttributeToSelect('*')
								->addAttributeToFilter('status', 1)
							    ->addAttributeToFilter('visibility', 4)
								->setOrder('price', 'ASC');
												
					$menuType = 'product_type';
					$usedtypeAttributeValues = array();
												
					foreach($products1 as $product)
					{
					$usedtypeAttributeValues[$product->getData($menuType)] = $product->getAttributeText($menuType);
					}
                    $usedtypeAttributeValues1 = array_unique($usedtypeAttributeValues);
												
					
echo  '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 type-nav-block">';
echo '<li><span>Type</span> </li>';
					 
					$typeUrl = $category2->getUrl(); 
					$typefinalUrl = str_replace(".html","",$typeUrl);
					
					foreach($usedtypeAttributeValues1 as $key => $value) {
					
                    $typeKey = strtolower($value);
				    $typeKeynew = str_replace(" &","",$typeKey);
					$typeKeynew1 = str_replace(" ","-",$typeKeynew);
					$typeKeynew2 = str_replace("(","-",$typeKeynew1);
					$typeKeynew3 = str_replace(")","",$typeKeynew2);
					$finaltypeKey = str_replace(".","-",$typeKeynew3);
					
				    if($category2->getId() == 282){
				    if($value) { 
                   echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'">'.$value.'</a></li>';
                     } 
					 } else { 
					 if($value) { 
					echo '<li><a href="'.$typefinalUrl.'-type-'.$finaltypeKey.'.html">'.$value.'</a></li>';
					}
					}
					 }
                  echo '</div>';
				  
				//Type end
				
				//Brand Start
				
				   
				    $products = Mage::getModel('catalog/category')->load($category2->getId())
						  ->getProductCollection()
						  ->addAttributeToSelect('*')
						  ->addAttributeToFilter('status', 1)
						  ->addAttributeToFilter('visibility', 4)
						  ->setOrder('price', 'ASC');
												
				    $manufacturer = 'manufacturer';
				    $usedAttributeValues = array();
												
				    foreach($products as $product)
				    {
				    $usedAttributeValues[$product->getData($manufacturer)] = $product->getAttributeText($manufacturer);
				    }
                    $usedAttributeValues1 = array_unique($usedAttributeValues);
												
				   
				
                 echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 brand-menu-list">';
                  echo '<li><span>Brand</span> </li>';
                     
					$url = $category2->getUrl(); 
					$finalUrl = str_replace(".html","",$url);
					  
					$brand_1 = 0;
					foreach($usedAttributeValues1 as $key => $value) { 
					
                    $brandKey = strtolower($value);
					$brandKeynew = str_replace(" &","",$brandKey);
					$brandKeynew1 = str_replace(" ","-",$brandKeynew);
					$brandKeynew2 = str_replace("(","-",$brandKeynew1);
					$brandKeynew3 = str_replace(")","",$brandKeynew2);
					$finalBrandKey = str_replace(".","-",$brandKeynew3);
					 if($category2->getId() == 282){ 
               if($value && $value != '') {   
			  if($brand_1 >=9){
				  
			 
echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'" class="brandmore">More..</a></li>';			  
              
			   break;
				  }else{
              
   echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'?catid='.$key.'">'.$value.'</a></li>';
               
				  }
				  } 
               } else {
				  if($brand_1 >=9 ){
					 
			    
echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'" class="brandmore">More..</a></li>';
			 
			  break;
				  }else{
              
echo '<li><a href="'.$finalUrl.'-brand-'.$finalBrandKey.'.html">'.$value.'</a></li>';
					  
				  }
				  }
					 
					$brand_1++;
					} 
					
               echo  '</div>';

                // Brand end 				  
				
				// How to buy start
				  
				  $cid = $category2->getId(); 
                  echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 drag-down-menu">';
				echo '<li><span>Help</span> </li>';
				echo '<li><a href="javascript:void(0)" class="showfaqpopup" id="faq'.$cid.'">FAQs</a> </li>';
                  echo '</div>';	  
				  echo '<div class="faq'.$cid.'" style="display:none;">';
					echo Mage::getModel('catalog/category')->load($cid)->getFaq();
                 echo '</div>';
                  
				// How to buy end
                echo '</ul>';
		    echo '</li>';
		 }   	
echo '</ul>';
 } 
echo '</li>';
echo '</ul>';
echo ' <ul class="google-block">
	<li><img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/default/msupply/images/coming_soon_03.png'.'" alt="logo"/></li>
</ul></div>';