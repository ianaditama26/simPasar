<html>
   <head>
      <title>Cetak Nota</title>
      <!--Autocomplete-->
      <style>
         @media print{
            #tutupNota{
               display:none;
            }
         }
      </style>
   </head>
   {{--  onLoad="window.print();" --}}
   <body style="font-family:'Tahoma';font-size:10px;line-height:90%;">
      <center>
         <div style="width:300px;height:600px;border:solid 1px black;">
            <font style="text-transform:uppercase;font-size:11px;">TANDA TERIMA PEMBAYARAN RETRIBUSI <br> {{ $retribusi->mPasar->pasar->namaPasar }}</font><br>
            {{ $retribusi->mPasar->alamat }}<br>
            
            <table style="font-size:10px;float:left;">
               <tr>
                  <td style="width:50px;"><b>No. Faktur<b></td>
                  <td style="width:10px;text-align:Center;">:</td>
                  <td style="width:300px;">{{ $retribusi->noFaktur }}</td>
               </tr>
               <tr>
                  <td style="width:200px;"><b>Tanggal Pembayaran<b></td>
                  <td style="width:10px;text-align:Center;">:</td>
                  <td style="width:300px;">{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
               </tr>
            </table>
            
            <table style="font-size:10px;float:left;margin:5px 5px 10px 5px;" cellspacing="0">
               <tr style="text-align:center;">
                  <td style="width:10px;border-top:dashed 1px black;border-bottom:dashed 1px black;">Dari</td>

                  <td style="width:10px;border-top:dashed 1px black;border-bottom:dashed 1px black;">Sampai</td>

                  <td style="width:30px;border-top:dashed 1px black;border-bottom:dashed 1px black;">Jml hari.</td>
                  <td style="width:30px;border-top:dashed 1px black;border-bottom:dashed 1px black;">Retribusi</td>
                  <td style="width:30px;border-top:dashed 1px black;border-bottom:dashed 1px black;"></td>
                  <td style="width:30px;border-top:dashed 1px black;border-bottom:dashed 1px black;">Total</td>
               </tr>
               {{-- Detail tagihan --}}
               <tr style="font-size:10px;">
                  <td style="text-align:center;">{{ Carbon\Carbon::parse($dari)->format('d-m-Y') }}</td>
                  <td style="text-align:center;width:350px;">{{ Carbon\Carbon::parse($sampai)->format('d-m-Y') }}</td>
                  <td style="text-align:center;">{{ $hari }} hari</td>
                  <td style="text-align:center;">{{ number_format($retribusi->tarif, 0,',', '.') }}</td>
                  <td style="text-align:center;"></td>
                  <td style="text-align:center;">{{ number_format($retribusi->tarif * $hari, 0, ',', '.') }}</td>
               </tr>
               {{-- <tr>
                  <td style="width:400px;"><b>NPWR<b></td>
                  <td style="width:10px;text-align:Center;">:</td>
                  <td style="width:300px;">2121333434</td>
               </tr> --}}

               <tr>
                  <td style="width:300px;"><b>Nama<b></td>
                  <td style="width:10px;text-align:Center;">:</td>
                  <td style="width:300px;">{{ $retribusi->pedagang->nama }}</td>
               </tr>

               <tr>
                  <td style="width:300px;"><b>No lapak<b></td>
                  <td style="width:10px;text-align:Center;">:</td>
                  <td style="width:300px;">{{ $retribusi->lapak->noLapak }}</td>
               </tr>

               <tr>
                  <td style="width:300px;"><b>Luas lapak<b></td>
                  <td style="width:10px;text-align:Center;">:</td>
                  <td style="width:300px;">{{ $retribusi->lapak->luas }}</td>
               </tr>
               
               <tr style="font-size:10px;">
                  <td colspan="6" style="text-align:right;border-top:Dashed 1px black;"></td>
               </tr>
            </table>
            Terima kasih <br>
            Struk ini merupakan tanda bukti pembayaran yang sah, harap disimpan bayarlah retribusi secara rutin dan tepat waktu
         </div>
         <button id="tutupNota" style="border:solid 1px black;background:#efefef;margin:5px 0 0 0;height:30px;color:Red;font-size:11px;" onclick="location.href='/admin/retribusi'">[X] Tutup Nota</button>
      </center>
   </body>
</html>