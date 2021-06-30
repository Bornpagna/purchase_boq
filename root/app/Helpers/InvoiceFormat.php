<?php

use App\Model\FormatInvoice;
use Illuminate\Support\Facades\Session;

function generatePrefix($prefix_type,$objModel,$columnName){
    try{
        $className = 'App\\Model\\' . $objModel;
        $obj =  new $className;
        $id="";
        $obj_format = FormatInvoice::where(['type'=>$prefix_type,'status'=>'1'])->first();
		if($obj_format){
            $prefix = $obj_format['prefix'];
            $subfix = $obj_format['subfix'];
            //////////////replace prefix year//////////////
            if(strpos($prefix, '!YY!')!== false){
                $prefix3 = str_replace('!YY!/', '!YY!', $prefix);
                $prefix3 = str_replace('!YY!-', '!YY!', $prefix3);
                $prefix3 = str_replace('!YY!\\', '!YY!', $prefix3);
                $prefix1 = str_replace('!YY!', date('y'), $prefix3);
                $prefix3 = str_replace('!YY!', '', $prefix3);
                $prefix = str_replace('!YY!', date('y'), $prefix);
                
                if(strpos($prefix1, '!M!')!== false){
                    $prefix3 = str_replace('!M!/', '', $prefix3);
                    $prefix3 = str_replace('!M!-', '', $prefix3);
                    $prefix3 = str_replace('!M!\\','', $prefix3);
                    $prefix3 = str_replace('!M!', '', $prefix3);
                    
                    $prefix1 = str_replace('!M!/', '', $prefix1);
                    $prefix1 = str_replace('!M!-', '', $prefix1);
                    $prefix1 = str_replace('!M!\\','', $prefix1);
                    $prefix1 = str_replace('!M!', '', $prefix1);
                    if(strpos($prefix1, '!D!')!== false){
                        $prefix3 = str_replace('!D!/', '', $prefix3);
                        $prefix3 = str_replace('!D!-', '', $prefix3);
                        $prefix3 = str_replace('!D!\\','', $prefix3);
                        $prefix3 = str_replace('!D!', '', $prefix3);
                        
                        $prefix1 = str_replace('!D!/', '', $prefix1);
                        $prefix1 = str_replace('!D!-', '', $prefix1);
                        $prefix1 = str_replace('!D!\\','', $prefix1);
                        $prefix1 = str_replace('!D!', '', $prefix1);
                    }else if(strpos($prefix1, '!DD!')!== false){
                        $prefix3 = str_replace('!DD!/', '', $prefix3);
                        $prefix3 = str_replace('!DD!-', '', $prefix3);
                        $prefix3 = str_replace('!DD!\\', '', $prefix3);
                        $prefix3 = str_replace('!DD!', '', $prefix3);
                        
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                    }
                }else if(strpos($prefix1, '!MM!')!== false){
                    $prefix3 = str_replace('!MM!/', '', $prefix3);
                    $prefix3 = str_replace('!MM!-', '', $prefix3);
                    $prefix3 = str_replace('!MM!\\', '', $prefix3);
                    $prefix3 = str_replace('!MM!', '', $prefix3);
                    
                    $prefix1 = str_replace('!MM!/', '', $prefix1);
                    $prefix1 = str_replace('!MM!-', '', $prefix1);
                    $prefix1 = str_replace('!MM!\\', '', $prefix1);
                    $prefix1 = str_replace('!MM!', '', $prefix1);
                    if(strpos($prefix1, '!D!')!== false){
                        $prefix3 = str_replace('!D!/', '', $prefix3);
                        $prefix3 = str_replace('!D!-', '', $prefix3);
                        $prefix3 = str_replace('!D!\\', '', $prefix3);
                        $prefix3 = str_replace('!D!', '', $prefix3);
                        
                        $prefix1 = str_replace('!D!/', '', $prefix1);
                        $prefix1 = str_replace('!D!-', '', $prefix1);
                        $prefix1 = str_replace('!D!\\', '', $prefix1);
                        $prefix1 = str_replace('!D!', '', $prefix1);
                    }else if(strpos($prefix1, '!DD!')!== false){
                        $prefix3 = str_replace('!DD!/', '', $prefix3);
                        $prefix3 = str_replace('!DD!-', '', $prefix3);
                        $prefix3 = str_replace('!DD!\\', '', $prefix3);
                        $prefix3 = str_replace('!DD!', '', $prefix3);
                        
                        $prefix1 = str_replace('!DD!/', '', $prefix1);
                        $prefix1 = str_replace('!DD!-', '', $prefix1);
                        $prefix1 = str_replace('!DD!\\', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                    }
                }else if(strpos($prefix1, '!MMM!')!== false){
                    $prefix3 = str_replace('!MMM!/', '', $prefix3);
                    $prefix3 = str_replace('!MMM!-', '', $prefix3);
                    $prefix3 = str_replace('!MMM!\\', '', $prefix3);
                    $prefix3 = str_replace('!MMM!', '', $prefix3);
                    
                    $prefix1 = str_replace('!MMM!/', '', $prefix1);
                    $prefix1 = str_replace('!MMM!-', '', $prefix1);
                    $prefix1 = str_replace('!MMM!\\', '', $prefix1);
                    $prefix1 = str_replace('!MMM!', '', $prefix1);
                    if(strpos($prefix1, '!D!')!== false){
                        $prefix3 = str_replace('!D!/', '', $prefix3);
                        $prefix3 = str_replace('!D!-', '', $prefix3);
                        $prefix3 = str_replace('!D!\\', '', $prefix3);
                        $prefix3 = str_replace('!D!', '', $prefix3);
                        
                        $prefix1 = str_replace('!D!/', '', $prefix1);
                        $prefix1 = str_replace('!D!-', '', $prefix1);
                        $prefix1 = str_replace('!D!\\', '', $prefix1);
                        $prefix1 = str_replace('!D!', '', $prefix1);
                    }else if(strpos($prefix1, '!DD!')!== false){
                        $prefix3 = str_replace('!DD!/', '', $prefix3);
                        $prefix3 = str_replace('!DD!-', '', $prefix3);
                        $prefix3 = str_replace('!DD!\\', '', $prefix3);
                        $prefix3 = str_replace('!DD!', '', $prefix3);
                        
                        $prefix1 = str_replace('!DD!/', '', $prefix1);
                        $prefix1 = str_replace('!DD!-', '', $prefix1);
                        $prefix1 = str_replace('!DD!\\', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                    }
                }
            }else if(strpos($prefix, '!YYYY!')!== false){
                $prefix3 = str_replace('!YYYY!/', '!YYYY!', $prefix);
                $prefix3 = str_replace('!YYYY!-', '!YYYY!', $prefix3);
                $prefix3 = str_replace('!YYYY!\\','!YYYY!', $prefix3);
                $prefix1 = str_replace('!YYYY!', date('Y'), $prefix3);
                $prefix3 = str_replace('!YYYY!', '', $prefix3);
                $prefix = str_replace('!YYYY!', date('Y'), $prefix);
                
                if(strpos($prefix1, '!M!')!== false){
                    $prefix3 = str_replace('!M!/', '', $prefix3);
                    $prefix3 = str_replace('!M!-', '', $prefix3);
                    $prefix3 = str_replace('!M!\\', '', $prefix3);
                    $prefix3 = str_replace('!M!', '', $prefix3);
                    
                    $prefix1 = str_replace('!M!/', '', $prefix1);
                    $prefix1 = str_replace('!M!-', '', $prefix1);
                    $prefix1 = str_replace('!M!\\', '', $prefix1);
                    $prefix1 = str_replace('!M!', '', $prefix1);
                    if(strpos($prefix1, '!D!')!== false){
                        $prefix3 = str_replace('!D!/', '', $prefix3);
                        $prefix3 = str_replace('!D!-', '', $prefix3);
                        $prefix3 = str_replace('!D!\\', '', $prefix3);
                        $prefix3 = str_replace('!D!', '', $prefix3);
                        
                        $prefix1 = str_replace('!D!/', '', $prefix1);
                        $prefix1 = str_replace('!D!-', '', $prefix1);
                        $prefix1 = str_replace('!D!\\', '', $prefix1);
                        $prefix1 = str_replace('!D!', '', $prefix1);
                    }else if(strpos($prefix1, '!DD!')!== false){
                        $prefix3 = str_replace('!DD!/', '', $prefix3);
                        $prefix3 = str_replace('!DD!-', '', $prefix3);
                        $prefix3 = str_replace('!DD!\\', '', $prefix3);
                        $prefix3 = str_replace('!DD!', '', $prefix3);
                        
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                    }
                }else if(strpos($prefix1, '!MM!')!== false){
                    $prefix3 = str_replace('!MM!/', '', $prefix3);
                    $prefix3 = str_replace('!MM!-', '', $prefix3);
                    $prefix3 = str_replace('!MM!\\', '', $prefix3);
                    $prefix3 = str_replace('!MM!', '', $prefix3);
                    
                    $prefix1 = str_replace('!MM!/', '', $prefix1);
                    $prefix1 = str_replace('!MM!-', '', $prefix1);
                    $prefix1 = str_replace('!MM!\\', '', $prefix1);
                    $prefix1 = str_replace('!MM!', '', $prefix1);
                    if(strpos($prefix1, '!D!')!== false){
                        $prefix3 = str_replace('!D!/', '', $prefix3);
                        $prefix3 = str_replace('!D!-', '', $prefix3);
                        $prefix3 = str_replace('!D!\\', '', $prefix3);
                        $prefix3 = str_replace('!D!', '', $prefix3);
                        
                        $prefix1 = str_replace('!D!/', '', $prefix1);
                        $prefix1 = str_replace('!D!-', '', $prefix1);
                        $prefix1 = str_replace('!D!\\', '', $prefix1);
                        $prefix1 = str_replace('!D!', '', $prefix1);
                    }else if(strpos($prefix1, '!DD!')!== false){
                        $prefix3 = str_replace('!DD!/', '', $prefix3);
                        $prefix3 = str_replace('!DD!-', '', $prefix3);
                        $prefix3 = str_replace('!DD!\\', '', $prefix3);
                        $prefix3 = str_replace('!DD!', '', $prefix3);
                        
                        $prefix1 = str_replace('!DD!/', '', $prefix1);
                        $prefix1 = str_replace('!DD!-', '', $prefix1);
                        $prefix1 = str_replace('!DD!\\', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                    }
                }else if(strpos($prefix1, '!MMM!')!== false){
                    $prefix3 = str_replace('!MMM!/', '', $prefix3);
                    $prefix3 = str_replace('!MMM!-', '', $prefix3);
                    $prefix3 = str_replace('!MMM!\\', '', $prefix3);
                    $prefix3 = str_replace('!MMM!', '', $prefix3);
                    
                    $prefix1 = str_replace('!MMM!/', '', $prefix1);
                    $prefix1 = str_replace('!MMM!-', '', $prefix1);
                    $prefix1 = str_replace('!MMM!\\', '', $prefix1);
                    $prefix1 = str_replace('!MMM!', '', $prefix1);
                    if(strpos($prefix1, '!D!')!== false){
                        $prefix3 = str_replace('!D!/', '', $prefix3);
                        $prefix3 = str_replace('!D!-', '', $prefix3);
                        $prefix3 = str_replace('!D!\\', '', $prefix3);
                        $prefix3 = str_replace('!D!', '', $prefix3);
                        
                        $prefix1 = str_replace('!D!/', '', $prefix1);
                        $prefix1 = str_replace('!D!-', '', $prefix1);
                        $prefix1 = str_replace('!D!\\', '', $prefix1);
                        $prefix1 = str_replace('!D!', '', $prefix1);
                    }else if(strpos($prefix1, '!DD!')!== false){
                        $prefix3 = str_replace('!DD!/', '', $prefix3);
                        $prefix3 = str_replace('!DD!-', '', $prefix3);
                        $prefix3 = str_replace('!DD!\\', '', $prefix3);
                        $prefix3 = str_replace('!DD!', '', $prefix3);
                        
                        $prefix1 = str_replace('!DD!/', '', $prefix1);
                        $prefix1 = str_replace('!DD!-', '', $prefix1);
                        $prefix1 = str_replace('!DD!\\', '', $prefix1);
                        $prefix1 = str_replace('!DD!', '', $prefix1);
                    }
                }
            }
            
            ////////////// replace prefix month //////////////
            if(strpos($prefix, '!M!')!== false){
                $prefix2 = str_replace('!M!/', '!M!', $prefix);
                $prefix2 = str_replace('!M!-', '!M!', $prefix2);
                $prefix2 = str_replace('!M!\\', '!M!', $prefix2);
                $prefix2 = str_replace('!M!', date('n'), $prefix2);
                $prefix = str_replace('!M!', date('n'), $prefix);
                if(strpos($prefix2, '!D!')!== false){
                    $prefix2 = str_replace('!D!/', '', $prefix2);
                    $prefix2 = str_replace('!D!-', '', $prefix2);
                    $prefix2 = str_replace('!D!\\', '', $prefix2);
                    $prefix2 = str_replace('!D!', '', $prefix2);
                }else if(strpos($prefix2, '!DD!')!== false){
                    $prefix2 = str_replace('!DD!/', '', $prefix2);
                    $prefix2 = str_replace('!DD!-', '', $prefix2);
                    $prefix2 = str_replace('!DD!\\', '', $prefix2);
                    $prefix2 = str_replace('!DD!', '', $prefix2);
                }
            }else if(strpos($prefix, '!MM!')!== false){
                $prefix2 = str_replace('!MM!/', '!MM!', $prefix);
                $prefix2 = str_replace('!MM!-', '!MM!', $prefix2);
                $prefix2 = str_replace('!MM!\\', '!MM!', $prefix2);
                $prefix2 = str_replace('!MM!', date('m'), $prefix2);
                $prefix = str_replace('!MM!', date('m'), $prefix);
                if(strpos($prefix2, '!D!')!== false){
                    $prefix2 = str_replace('!D!/', '', $prefix2);
                    $prefix2 = str_replace('!D!-', '', $prefix2);
                    $prefix2 = str_replace('!D!\\', '', $prefix2);
                    $prefix2 = str_replace('!D!', '', $prefix2);
                }else if(strpos($prefix2, '!DD!')!== false){
                    $prefix2 = str_replace('!DD!/', '', $prefix2);
                    $prefix2 = str_replace('!DD!-', '', $prefix2);
                    $prefix2 = str_replace('!DD!\\', '', $prefix2);
                    $prefix2 = str_replace('!DD!', '', $prefix2);
                }
            }else if(strpos($prefix, '!MMM!')!== false){
                $prefix2 = str_replace('!MMM!/', '!MMM!', $prefix);
                $prefix2 = str_replace('!MMM!-', '!MMM!', $prefix2);
                $prefix2 = str_replace('!MMM!\\','!MMM!', $prefix2);
                $prefix2 = str_replace('!MMM!', date('M'), $prefix2);
                $prefix = str_replace('!MMM!', date('M'), $prefix);
                if(strpos($prefix2, '!D!')!== false){
                    $prefix2 = str_replace('!D!/', '', $prefix2);
                    $prefix2 = str_replace('!D!-', '', $prefix2);
                    $prefix2 = str_replace('!D!\\', '', $prefix2);
                    $prefix2 = str_replace('!D!', '', $prefix2);
                }else if(strpos($prefix2, '!DD!')!== false){
                    $prefix2 = str_replace('!DD!/', '', $prefix2);
                    $prefix2 = str_replace('!DD!-', '', $prefix2);
                    $prefix2 = str_replace('!DD!\\', '', $prefix2);
                    $prefix2 = str_replace('!DD!', '', $prefix2);
                }
            }
            
            ////////////// replace prefix year //////////////
            if(strpos($prefix, '!D!')!== false){
                $prefix = str_replace('!D!', date('j'), $prefix);
            }else if(strpos($prefix, '!DD!')!== false){
                $prefix = str_replace('!DD!', date('d'), $prefix);
            }
            
            $length = $obj_format['length'];
            $start_from = $obj_format['start_from'];
            $interval = $obj_format['interval'];
            $round = $obj_format['duration_round'];
            $pro_id = Session::get('project');
            if($round=="Y"){
				// return $prefix2;
                $obj_invoice = $obj::select(DB::raw("MAX($columnName) AS example"))
                                        ->where('pro_id', '=', $pro_id)
                                        ->where($columnName, 'like', $prefix1.'%')
                                        ->where($columnName, 'like', '%'.$subfix)->first();
            }else if($round=="M"){
				// return $prefix2;
                $obj_invoice = $obj::select(DB::raw("MAX($columnName) AS example"))
										->where('pro_id', '=', $pro_id)
                                        ->where($columnName, 'like', $prefix2.'%')
                                        ->where($columnName, 'like', '%'.$subfix)->first();
            }else if($round=="D"){
				// return $prefix2;
                $obj_invoice = $obj::select(DB::raw("MAX($columnName) AS example"))
										->where('pro_id', '=', $pro_id)
                                        ->where($columnName, 'like', $prefix.'%')
                                        ->where($columnName, 'like', '%'.$subfix)->first();
            }else{
				// return $prefix2;
                $obj_invoice = $obj::select(DB::raw("MAX($columnName) AS example"))
										->where('pro_id', '=', $pro_id)
                                        ->where($columnName, 'like', $prefix3.'%')
                                        ->where($columnName, 'like', '%'.$subfix)->first();
            }

            if($obj_invoice->example){
                $str = $obj_invoice->example;
                $id = substr($str, strlen($prefix), $length);
                $id = (int)$id;
                if($id>0){
                    $id = $id + $interval;
                    $id = str_pad($id, $length, "0", STR_PAD_LEFT);
                    return $prefix.$id.$subfix;
                }
            }
            $id = str_pad($start_from, $length, "0", STR_PAD_LEFT);
            return $prefix.$id.$subfix;
        }
        return $id;
    }catch(\Exception $e){
        return '';
    }
}
