<?php

error_reporting(0);

include("rpc.php");

$kpc = new Keva();

$kpc->username=$krpcuser;
$kpc->password=$krpcpass;
$kpc->host=$krpchost;
$kpc->port=$krpcport;

$asset="NNA411dJNc5tiC4Lc3RkF8d8oQWQJ6X8p3";


$namespace= $kpc->keva_get($asset,"_KEVA_NS_");

$title=$namespace['value'];


				$snl=strlen($namespace['height']);
				$snm=$namespace['height'];

				

				$getblockh=$kpc->getblockheaderbyheight($snm);
			
				$getblockh=$getblockh['block_header']['hash'];
				$getblocktx=$kpc->getblock($getblockh);

			
				$sncount=0;
		
					foreach($getblocktx['tx'] as $txa)

						{

				
						$transaction= $kpc->getrawtransaction($txa,1);

							foreach($transaction['vout'] as $vout)
	   
							  {

								$op_return = $vout["scriptPubKey"]["asm"]; 

				
									$arrb = explode(' ', $op_return); 

									if($arrb[0] == 'OP_KEVA_NAMESPACE') 
										{

								 $cona=$arrb[0];
								 $cons=$arrb[1];
								 $conk=$arrb[2];
								  $cond=$vout["scriptPubKey"]["addresses"][0];

								 $assetn=Base58Check::encode($cons, false , 0 , false);

								 if($asset==$assetn){ $sn=$snl."".$snm."".$sncount;}

										}
								 }
				
							

						$sncount=$sncount+1;

						}
				

				
echo "Namespace: ".$title."<br><br>";
echo  $asset."<br><br>";
echo "Short code: ".$sn;




?>