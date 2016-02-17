<?php
include_once 'app/Mage.php';
Mage::app();
echo '<div class="width15 inner-nav">';
echo '<a class="default showhide1" id="showhide1"><i class="fa fa-bars"></i><p>Shop</p></a>';

echo '<div id="menuBLock" class="category-list1" style="display:none;">';
  
    $children = Mage::getModel('catalog/category')->load(2); 
    $_category1 =  $children->getChildrenCategories();
    
     foreach ($_category1 as $category1) { 
 echo '<li class="mainNav"><a class="main-nav1" href="'.$category1->getUrl().'">';
     
      $cid =  $category1->getId();
       echo $category1->getName();
         echo '<span class="fa fa-plus mobile-dropdown"></span><span class="fa fa-minus mobile-dropdown"></span> <span class="fa fa-angle-right desktop-dropdown"></span> </a>
    <ul class="subNavLevel1">';
            
            $catId1 = $category1->getId();
            $children1 = Mage::getModel('catalog/category')->load($catId1); 
            $_category2 =  $children1->getChildrenCategories();
           foreach ($_category2 as $category2) { 
           echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'">'.$category2->getName().'</a>';
            echo '<ul class="brand-list">';
            
            // Type Start
             
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
                            
             
             echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 type-nav-block">
                        <li><span>Type</span> </li>';
               
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
             echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'"><?php echo $value; ?></a></li>';
              } 
              } else { 
               if($value) {  
              echo '<li><a href="'.$typefinalUrl.'-type-'.$finaltypeKey.'.html">'.$value.'</a></li>';
               } 
               } 
               } 
               echo '</div>';
              
            //Type end
            
            //Brand end
            
                
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
                
			  $brand_1 = 1;
			  foreach($usedAttributeValues1 as $key => $value) { 
             
                        $brandKey = strtolower($value);
                    $brandKeynew = str_replace(" &","",$brandKey);
          $brandKeynew1 = str_replace(" ","-",$brandKeynew);
          $brandKeynew2 = str_replace("(","-",$brandKeynew1);
          $brandKeynew3 = str_replace(")","",$brandKeynew2);
          $finalBrandKey = str_replace(".","-",$brandKeynew3);
              
                 if($category2->getId() == 282){ 
               if($value) { 
 if($brand_1 >=9){
					  
			   
echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'" class="brandmore">More..</a></li>';	  
             
			   break;
				  }else{
			  
             echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'?catid='.$key.'">'.$value.'</a></li>';
               
				  }
			  } 
               } else { 
			  if($brand_1 >=9){
					 	  
			   
echo '<li><a alt="'.$category2->getName().'" title="'.$category2->getName().'" rel="canonical" href="'.$category2->getUrl().'" class="brandmore">More</a></li>';			  
              
			   break;
				  }else{
echo '<li><a href="'.$finalUrl.'-brand-'.$finalBrandKey.'.html">'.$value.'</a></li>';

             					  
				  }
				  }  
					$brand_1++;
					} 
					
             echo '</div>';

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
 echo ' </li>
  </div>
</div>';

