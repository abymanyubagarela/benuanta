<?php  

	class MLaporan extends CI_Model {
		
        public function __construct() {
			parent::__construct();
	    }

        public function mbast($detail,$items) {
            $filename="./uploads/bast/".$detail->id.".pdf";     

            $height = 6;
            $border = 0;
            $tableBorder = 1; 
            $ln = 2;

            $dat = date("d");
            $hari = date("l");
            $bulan = date("m");
            $tahun = date("Y");

            //Setting orientasi dan ukuran halaman
            $pdf = new FPDF('P','mm','A4');

            // membuat halaman baru
            $pdf->AddPage();
            
            // setting font untuk Header
            $pdf->SetFont('Arial','B',12);
            
            // mencetak string header
            $pdf->Cell(0,$height,'BERITA ACARA SERAH TERIMA',$border,$ln,'C');
            $pdf->Cell(0,$height,'PERANGKAT KOMPUTERISASI PERKANTORAN',$border,$ln,'C');
            $pdf->Cell(0,$height,'PERWAKILAN BPK-RI DI JAKARTA',$border,$ln,'C');
            $pdf->Cell(0,$height,'TAHUN ANGGARAN 2021',$border,$ln,'C');
            // end mencetak string header
            
            // Mencetak Garis dibawah header
            $pdf->SetLineWidth(0.8);
            $pdf->Line(40,37,170,37);
            // End Mencetak Garis dibawah header
            $pdf->SetLineWidth(0);
            // re-setting font
            $pdf->SetFont('Arial','',10);
            
            // mencetak string nomor bast      
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'No.   / BAST / INV / '.$bulan.' / '.$tahun,$border,$ln,'C');
            // end mencetak string nomor bast

            // mencetak string pernyataan
            $pdf->Cell(0,$height,'Pada hari ini '.$this->getDay($hari).', tanggal '.ucwords($this->getDate($dat)).' '.$this->getMonth($bulan).' tahun '.ucwords($this->getTahun($tahun)).', yang bertanda tangan dibawah ini:',$border,$ln,'C');
            $pdf->Cell(0,4,'',$border,$ln,'C');
            // end mencetak string pernyataan
            

            // MENCETAK DATA PIHAK PERTAMA

            // Nama
            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'Nama',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,'Dasril Awal',$border,1,'L');

            // Jabatan
            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'Jabatan',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,'Kepala Subbagian Umum dan TI',$border,1,'L');

            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'',$border,0,'L');
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(0,$height,'BPK-RI Perwakilan Provinsi DKI Jakarta',$border,1,'L');

            // Alamat
            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'Alamat',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,'Jl. MT Haryono Kav. 34 Jakarta',$border,1,'L');

            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(50,$height,'Selanjutnya disebut sebagai ',$border,0,'L');

            // re-setting font bold
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,$height,'PIHAK PERTAMA',$border,1,'L');
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            
            // re-setting font normal
            $pdf->SetFont('');

            // END MENCETAK DATA PIHAK PERTAMA


            // MENCETAK DATA PIHAK KEDUA

            // Nama
            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'Nama',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->peminjam,$border,1,'L');

            // Jabatan
            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'Jabatan',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->jabatan,$border,1,'L');

            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'',$border,0,'L');
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(0,$height,'BPK-RI Perwakilan Provinsi DKI Jakarta',$border,1,'L');

            // Alamat
            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'Alamat',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,'Jl. MT Haryono Kav. 34 Jakarta',$border,1,'L');

            $pdf->Cell(20,$height,'',$border,0,'C');
            $pdf->Cell(50,$height,'Selanjutnya disebut sebagai ',$border,0,'L');

            // re-setting font bold
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,$height,'PIHAK KEDUA',$border,1,'L');
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            
            // re-setting font normal
            $pdf->SetFont('');

            // END MENCETAK DATA PIHAK KEDUA


            // Mencetak pernyataan
            // overflow
            // $pdf->Cell(0,$height,'Pihak Pertama menyerahkan kepada Pihak Kedua berupa perangkat komputerisasi perkantoran dengan rincian sebagai berikut:',$border,$ln,'L');

            $pdf->MultiCell( 0, $height, "Pihak Pertama menyerahkan kepada Pihak Kedua berupa perangkat komputerisasi perkantoran dengan rincian sebagai berikut:", 0);
            $pdf->Cell(0,3,'',$border,1,'C');

            // Mencetak tabel perangkat yang dipinjam
            $pdf->Cell(15,$height,'',$border,0,'C');
            $pdf->Cell(10,$height,'No.',$tableBorder,0,'C');
            $pdf->Cell(105,$height,'Jenis Barang',$tableBorder,0,'C');
            $pdf->Cell(45,$height,'Kuantitas',$tableBorder,1,'C');
            // End Mencetak tabel perangkat yang dipinjam


            foreach ($items as $key => $item) {

                // print_r($item->bmn);die();
                $pdf->Cell(15,$height,'',$border,0,'C');
                $pdf->Cell(10,$height,$key+1,"LR",0,'C');
                $pdf->Cell(105,$height,$item->perangkat.' '.$item->merk,"LR",0,'L');
                $pdf->Cell(45,$height,$item->jumlah,"LR",1,'C');

                $arr_bmn = explode(";",$item->bmn);
                $arr_clean = array();
                foreach ($arr_bmn as $key => $v) {
                    if(!empty($v)) {
                       array_push($arr_clean,$v);
                    }                                                                    
                }
                // $count = 0;

                // print_r(count($arr_clean));die(); 
                // start bast
                if(count($arr_clean) > 1) {
                    foreach ($arr_bmn as $key => $v) {
                        if(!empty($v)) {                        
                            if(count($arr_clean) == $key+1) {
                                $pdf->Cell(15,$height,'',$border,0,'C');
                                $pdf->Cell(10,$height,'',"LRB",0,'C');
                                $pdf->Cell(105,$height,$v,"LRB",0,'L');
                                $pdf->Cell(45,$height,'',"LRB",1,'C');
                            } else {
                                $pdf->Cell(15,$height,'',$border,0,'C');
                                $pdf->Cell(10,$height,'',"LR",0,'C');
                                $pdf->Cell(105,$height,$v,"LR",0,'L');
                                $pdf->Cell(45,$height,'',"LR",1,'C');
                            }
                            // $count++;
                        }                                                                    
                    }    
                } else {
                    $pdf->Cell(15,$height,'',$border,0,'C');
                    $pdf->Cell(10,$height,'',"LRB",0,'C');
                    $pdf->Cell(105,$height,$arr_clean[0],"LRB",0,'L');
                    $pdf->Cell(45,$height,'',"LRB",1,'C');
                }
                // die();
            }

            $total = 0;
            
            // Mencetak penutupan
            $y = $pdf->getY();
            $pdf->setY($y + 5*$total);
            $pdf->Cell(0,$height,'',$border,1,'C');
            $pdf->MultiCell( 0, $height, "Dengan demikian mulai saat penandatanganan berita acara ini, maka penggunaan dan pengelolaan serta pengurusan barang menjadi wewenang dan tanggung jawab PIHAK KEDUA. Namun Perangkat TI tersebut dapat ditarik kembali apabila sewaktu-waktu diperlukan", 0);
            $pdf->Cell(0,$height,'',$border,1,'C');

            // TANDA TANGAN

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(95,$height,'PIHAK KEDUA',$border,0,'C');
            $pdf->Cell(95,$height,'PIHAK PERTAMA',$border,1,'C');

            $pdf->SetFont('Arial','',10);
            $pdf->Cell(95,$height,'Yang Menerima,',$border,0,'C');
            $pdf->Cell(95,$height,'Yang Menyerahkan,',$border,1,'C');

            $pdf->Cell(0,$height,'',$border,1,'C');
            $pdf->Cell(0,$height,'',$border,1,'C');

            $pdf->SetFont('Arial','Bu',10);
            $pdf->Cell(95,$height,$detail->peminjam,$border,0,'C');
            $pdf->Cell(95,$height,'Dasril Awal',$border,1,'C');
            
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(95,$height,'NIP. '.$detail->fullnip,$border,0,'C');
            $pdf->Cell(95,$height,'NIP. 197504212002122004',$border,1,'C');

            // END TANDA TANGAN

            // $pdf->Output();
            $pdf->Output($filename,'F');
        }

        public function mpinjam($detail,$items) {
            $filename="./uploads/peminjaman/".$detail->id.".pdf";     
            $height = 6;
            $border = 0;
            $tableBorder = 1; 
            $ln = 2;

            
            $hari = date("d");
            $bulan = date("m");
            $tahun = date("Y");

            //Setting orientasi dan ukuran halaman
            $pdf = new FPDF('P','mm','A4');

            // membuat halaman baru
            $pdf->AddPage();

            // setting font Header
            $pdf->SetFont('Arial','B',14);
            
            // mencetak header 
            $pdf->Cell(0,$height,'Form Peminjaman Barang Milik Negara',$border,$ln,'C');
            $pdf->Cell(0,$height,'Badan Pemeriksa Keuangan Perwakilan Provinsi DKI Jakarta',$border,$ln,'C');
            // end mencetak header

            // re-setting font
            $pdf->SetFont('Arial','B',10);        
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'',$border,$ln,'C');

            // MENCETAK DATA PEMINJAM

            $pdf->Cell(0,$height,'I. Data Peminjam : ',$border,$ln,'L');
            
            //Reset Font
            $pdf->SetFont('Arial','',10);
            
            // Nama
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'1 Nama',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->peminjam,$border,1,'L');

            // NIP
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'2 NIP',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->fullnip,$border,1,'L');

            // Jabatan
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'3 Jabatan',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->jabatan,$border,1,'L');

            // Unit Kerja
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'4 Unit Kerja',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,'BPK Perwakilan Provinsi DKI Jakarta',$border,1,'L');
            
            // END MENCETAK DATA PEMINJAM

            // re-setting font
            $pdf->SetFont('Arial','B',10);        
            $pdf->Cell(0,$height,'',$border,$ln,'C');

            // MENCETAK DATA BMN
            $pdf->Cell(0,$height,'II. Data BMN : ',$border,$ln,'L');
            
            $pdf->Ln();
             // Mencetak tabel perangkat yang dipinjam
            $pdf->Cell(15,$height,'',$border,0,'C');
            $pdf->Cell(10,$height,'No.',$tableBorder,0,'C');
            $pdf->Cell(105,$height,'Jenis Barang',$tableBorder,0,'C');
            $pdf->Cell(45,$height,'Kuantitas',$tableBorder,1,'C');
            // End Mencetak tabel perangkat yang dipinjam

            foreach ($items as $key => $item) {

                // print_r($item->bmn);die();
                $pdf->Cell(15,$height,'',$border,0,'C');
                $pdf->Cell(10,$height,$key+1,"LR",0,'C');
                $pdf->Cell(105,$height,$item->perangkat.' '.$item->merk,"LR",0,'L');
                $pdf->Cell(45,$height,$item->jumlah,"LR",1,'C');

                $arr_bmn = explode(";",$item->bmn);
                $arr_clean = array();
                foreach ($arr_bmn as $key => $v) {
                    if(!empty($v)) {
                       array_push($arr_clean,$v);
                    }                                                                    
                }
                // $count = 0;

                // print_r(count($arr_clean));die(); 
                // start pinjam
                if(count($arr_clean) > 1) {
                    foreach ($arr_bmn as $key => $v) {
                        if(!empty($v)) {                        
                            if(count($arr_clean) == $key+1) {
                                $pdf->Cell(15,$height,'',$border,0,'C');
                                $pdf->Cell(10,$height,'',"LRB",0,'C');
                                $pdf->Cell(105,$height,$v.'-'.count($arr_clean),"LRB",0,'L');
                                $pdf->Cell(45,$height,'',"LRB",1,'C');
                            } else {
                                $pdf->Cell(15,$height,'',$border,0,'C');
                                $pdf->Cell(10,$height,'',"LR",0,'C');
                                $pdf->Cell(105,$height,$v,"LR",0,'L');
                                $pdf->Cell(45,$height,'',"LR",1,'C');
                            }
                            // $count++;
                        }                                                                    
                    }    
                } else {
                    $pdf->Cell(15,$height,'',$border,0,'C');
                    $pdf->Cell(10,$height,'',"LRB",0,'C');
                    $pdf->Cell(105,$height,$arr_clean[0],"LRB",0,'L');
                    $pdf->Cell(45,$height,'',"LRB",1,'C');
                }
                
                // die();
            }

            //Reset Font
            $pdf->SetFont('Arial','',10);

            // END MENCETAK DATA BMN

            $total = 0;
            // TANDA TANGAN
            $y = $pdf->getY();
            $pdf->setY($y + 5*$total);

            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'',$border,$ln,'C');

            $pdf->Cell(95,$height,'Diserahkan Oleh',$border,0,'C');
            $pdf->Cell(95,$height,'Diterima Oleh',$border,1,'C');

            $pdf->Cell(95,$height,'Kepala Sub Bagian Umum dan TI,',$border,0,'C');
            $pdf->Cell(95,$height,'Peminjam BMN,',$border,1,'C');

            $pdf->Cell(0,$height,'',$border,1,'C');
            $pdf->Cell(0,$height,'',$border,1,'C');

            $pdf->Cell(95,$height,'Dasril Awal',$border,0,'C');
            $pdf->Cell(95,$height,$detail->peminjam,$border,1,'C');
            
            $pdf->Cell(95,$height,'NIP. 240002424',$border,0,'C');
            $pdf->Cell(95,$height,'NIP. '.$detail->fullnip,$border,1,'C');

            $pdf->Cell(95,$height,'Tanggal :  '.$hari.' '.$this->getMonth($bulan).' '.$tahun,$border,0,'C');
            $pdf->Cell(95,$height,'Tanggal :  '.$hari.' '.$this->getMonth($bulan).' '.$tahun,$border,1,'C');

            // END TANDA TANGAN

            // Catatan Tambahan
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'Catatan Tambahan : ',$border,$ln,'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,$height,$detail->catatan,$border,1,'L');
            // End Catatan Tambahan

            // $pdf->Output();
            $pdf->Output($filename,'F');
        }

        public function mkembali($detail,$items) {
            $filename="./uploads/pengembalian/".$detail->id.".pdf";     
            $height = 6;
            $border = 0;
            $tableBorder = 1; 
            $ln = 2;

            
            $hari = date("d");
            $bulan = date("m");
            $tahun = date("Y");

            //Setting orientasi dan ukuran halaman
            $pdf = new FPDF('P','mm','A4');

            // membuat halaman baru
            $pdf->AddPage();

            // setting font Header
            $pdf->SetFont('Arial','B',14);
            
            // mencetak header 
            $pdf->Cell(0,$height,'Form Pengembalian Barang Milik Negara',$border,$ln,'C');
            $pdf->Cell(0,$height,'Badan Pemeriksa Keuangan Perwakilan Provinsi DKI Jakarta',$border,$ln,'C');
            // end mencetak header

            // re-setting font
            $pdf->SetFont('Arial','B',10);        
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'',$border,$ln,'C');

            // MENCETAK DATA PEMINJAM

            $pdf->Cell(0,$height,'I. Data Peminjam : ',$border,$ln,'L');
            
            //Reset Font
            $pdf->SetFont('Arial','',10);
            
            // Nama
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'1 Nama',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->peminjam,$border,1,'L');

            // NIP
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'2 NIP',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->fullnip,$border,1,'L');

            // Jabatan
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'3 Jabatan',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,$detail->jabatan,$border,1,'L');

            // Unit Kerja
            $pdf->Cell(10,$height,'',$border,0,'C');
            $pdf->Cell(40,$height,'4 Unit Kerja',$border,0,'L');
            $pdf->Cell(10,$height,':',$border,0,'C');
            $pdf->Cell(0,$height,'BPK Perwakilan Provinsi DKI Jakarta',$border,1,'L');
            
            // END MENCETAK DATA PEMINJAM

            // re-setting font
            $pdf->SetFont('Arial','B',10);        
            $pdf->Cell(0,$height,'',$border,$ln,'C');

            // MENCETAK DATA BMN
            $pdf->Cell(0,$height,'II. Data BMN : ',$border,$ln,'L');
            
            $pdf->Ln();
             // Mencetak tabel perangkat yang dipinjam
            $pdf->Cell(15,$height,'',$border,0,'C');
            $pdf->Cell(10,$height,'No.',$tableBorder,0,'C');
            $pdf->Cell(105,$height,'Jenis Barang',$tableBorder,0,'C');
            $pdf->Cell(45,$height,'Kuantitas',$tableBorder,1,'C');
            // End Mencetak tabel perangkat yang dipinjam

           foreach ($items as $key => $item) {

                // print_r($item->bmn);die();
                $pdf->Cell(15,$height,'',$border,0,'C');
                $pdf->Cell(10,$height,$key+1,"LR",0,'C');
                $pdf->Cell(105,$height,$item->perangkat.' '.$item->merk,"LR",0,'L');
                $pdf->Cell(45,$height,$item->jumlah,"LR",1,'C');

                $arr_bmn = explode(";",$item->bmn);
                $arr_clean = array();
                foreach ($arr_bmn as $key => $v) {
                    if(!empty($v)) {
                       array_push($arr_clean,$v);
                    }                                                                    
                }
                // $count = 0;

                // print_r(count($arr_clean));die(); 
                // start kembali
                if(count($arr_clean) > 1) {
                    foreach ($arr_bmn as $key => $v) {
                        if(!empty($v)) {                        
                            if(count($arr_clean) == $key+1) {
                                $pdf->Cell(15,$height,'',$border,0,'C');
                                $pdf->Cell(10,$height,'',"LRB",0,'C');
                                $pdf->Cell(105,$height,$v,"LRB",0,'L');
                                $pdf->Cell(45,$height,'',"LRB",1,'C');
                            } else {
                                $pdf->Cell(15,$height,'',$border,0,'C');
                                $pdf->Cell(10,$height,'',"LR",0,'C');
                                $pdf->Cell(105,$height,$v,"LR",0,'L');
                                $pdf->Cell(45,$height,'',"LR",1,'C');
                            }
                            // $count++;
                        }                                                                    
                    }    
                } else {
                    $pdf->Cell(15,$height,'',$border,0,'C');
                    $pdf->Cell(10,$height,'',"LRB",0,'C');
                    $pdf->Cell(105,$height,$arr_clean[0],"LRB",0,'L');
                    $pdf->Cell(45,$height,'',"LRB",1,'C');
                }
                
                // die();
            }

            $total = 0;
           
            //Reset Font
            $pdf->SetFont('Arial','',10);

            // END MENCETAK DATA BMN


            // TANDA TANGAN
            $y = $pdf->getY();
            $pdf->setY($y + 5*$total);

            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'',$border,$ln,'C');

            $pdf->Cell(95,$height,'Dikembalikan Oleh',$border,0,'C');
            $pdf->Cell(95,$height,'Diterima Oleh',$border,1,'C');

            $pdf->Cell(95,$height,'Peminjam BMN,',$border,0,'C');
            $pdf->Cell(95,$height,'Kepala Sub Bagian Umum dan TI,',$border,1,'C');

            $pdf->Cell(0,$height,'',$border,1,'C');
            $pdf->Cell(0,$height,'',$border,1,'C');

            $pdf->Cell(95,$height,$detail->peminjam,$border,0,'C');
            $pdf->Cell(95,$height,'Dasril Awal',$border,1,'C');
            
            $pdf->Cell(95,$height,'NIP. '.$detail->fullnip,$border,0,'C');
            $pdf->Cell(95,$height,'NIP. 240002424',$border,1,'C');
            

            $pdf->Cell(95,$height,'Tanggal :  '.$hari.' '.$this->getMonth($bulan).' '.$tahun,$border,0,'C');
            $pdf->Cell(95,$height,'Tanggal :  '.$hari.' '.$this->getMonth($bulan).' '.$tahun,$border,1,'C');

            // END TANDA TANGAN

            // Catatan Tambahan
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,$height,'',$border,$ln,'C');
            $pdf->Cell(0,$height,'Catatan Tambahan : ',$border,$ln,'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,$height,$detail->keterangan,$border,1,'L');
            // End Catatan Tambahan

            // $pdf->Output();
            $pdf->Output($filename,'F');
        }

        public function getMonth($value){
            $months = array(
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );

            return $months[$value-1];
        }

        public function getDay($value){
            switch ($value) {
                case 'Monday':
                    return 'Senin';
                    break;

                case 'Tuesday':
                    return 'Selasa';
                    break;

                case 'Wednesday':
                    return 'Rabu';
                    break;

                case 'Thursday':
                    return 'Kamis';
                    break;

                case 'Friday':
                    return 'Jumat';
                    break;

                case 'Saturday':
                    return 'Sabtu';
                    break;
                
                default:
                    return 'Minggu';
                    break;
            }
        }

        public function getDate($value){
            switch ($value) {
                case '1':
                    return 'satu';
                    break;

                case '2':
                    return 'dua';
                    break;

                case '3':
                    return 'tiga';
                    break;

                case '4':
                    return 'empat';
                    break;

                case '5':
                    return 'lima';
                    break;

                case '6':
                    return 'enam';
                    break;

                case '7':
                    return 'tujuh';
                    break;

                case '8':
                    return 'delapan';
                    break;

                case '9':
                    return 'sembilan';
                    break;

                case '10':
                    return 'sepuluh';
                    break;

                case '11':
                    return 'sebelas';
                    break;

                case '12':
                    return 'dua belas';
                    break;

                case '13':
                    return 'tiga belas';
                    break;

                case '14':
                    return 'empat belas';
                    break;

                case '15':
                    return 'lima belas';
                    break;

                case '16':
                    return 'enam belas';
                    break;

                case '17':
                    return 'tujuh belas';
                    break;

                case '18':
                    return 'delapan belas';
                    break;

                case '19':
                    return 'sembilan belas';
                    break;

                case '20':
                    return 'dua pulus';
                    break;

                case '21':
                    return 'dua puluh satu';
                    break;

                case '22':
                    return 'dua puluh dua';
                    break;

                case '23':
                    return 'dua puluh tiga';
                    break;

                case '24':
                    return 'dua puluh empat';
                    break;

                case '25':
                    return 'dua puluh lima';
                    break;

                case '26':
                    return 'dua puluh enam';
                    break;

                case '27':
                    return 'dua puluh tujuh';
                    break;

                case '28':
                    return 'dua puluh delapan';
                    break;

                case '29':
                    return 'dua puluh sembilan';
                    break;

                case '30':
                    return 'tiga puluh';
                    break;
                
                default:
                    return 'tiga puluh satu';
                    break;
            }
        }

        public function getTahun($value){
            switch ($value) {
                case '2021':
                    return 'dua ribu dua puluh satu';
                    break;

                case '2022':
                    return 'dua ribu dua puluh dua';
                    break;


                case '2023':
                    return 'dua ribu dua puluh tiga';
                    break;

                case '2024':
                    return 'dua ribu dua puluh empat';
                    break;

                case '2025':
                    return 'dua ribu dua puluh lima';
                    break;
                
                default:
                    return 'dua ribu dua puluh enam';
                    break;
            }
        }
	}

?>