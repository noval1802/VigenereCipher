<?php
/*
 *  Nama		: Abdul Aziz Anaoval
 *  Nim			: 312010049
 *  Matkul	: Kriptografi
 *  date		: 10/10/2022
 */

class Vigenere_Cipher {

	protected $abjad = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "x");
	protected $myencript = array();

	public function table_reference() {
		#membuat table referensi
		$abjad = $this->abjad;
		$keyno = 0;
		echo "<table border=1>";
		for ($a = 0; $a < 26; $a++) {
			echo "<tr>";
			for ($i = $a; $i <= 25; $i++) {
				echo "<td>" . $abjad[$i] . "</td>";
				$keyno++;
				if ($i >= 25) {
					for ($l = 0; $l <= 25 - $keyno; $l++) {
						echo "<td>" . $abjad[$l] . "</td>";
					}
				}
			}
			echo "</tr>";
			$keyno = 0;
		}
		echo "</table>";
	}
	protected function __rumus_encript() {
		#membuat table referensi
		$abjad = $this->abjad;
		$keyno = 0;
		for ($a = 0; $a < 26; $a++) {
			for ($i = $a; $i <= 25; $i++) {
				$abjadke = ($a + $i > 25) ? $a + $i - 26 : $a + $i;
				$this->myencript[$abjad[$a] . $abjad[$i]] = $abjad[$abjadke];
				$this->myencript[$abjad[$i] . $abjad[$a]] = $abjad[$abjadke];
				$keyno++;
				if ($i >= 25) {
					for ($l = 0; $l <= 25 - $keyno; $l++) {
						$abjadke = ($a + $l > 25) ? $a + $l - 26 : $a + $l;
						$this->myencript[$abjad[$a] . $abjad[$l]] = $abjad[$abjadke];
						$this->myencript[$abjad[$l] . $abjad[$a]] = $abjad[$abjadke];
					}
				}
			}
			$keyno = 0;
		}
	}
	
	public function encrypt($kunci,$pesan){
		$this->__rumus_encript();
		$pesan = str_split(str_replace(" ",'',$pesan));
		$kunci = str_split(str_replace(" ","",$kunci));
		$jumlah_kunci = count($kunci);
		$no_kunci = 0;
		$hasil = '';
		foreach($pesan as $key => $value){
			$hasil .= $this->myencript[$kunci[$no_kunci] . $value];
			$no_kunci = (++$no_kunci == $jumlah_kunci) ? 0 : $no_kunci;
		}
		return $hasil;
	}
	
	protected function __rumus_decript($keys,$encript){
		$abjad = $this->abjad;
		$val = 0;
		foreach ($abjad as $key => $value) {
			$to_decript[$value] = $val++;
		}

		$hasil = $to_decript[$encript] - $to_decript[$keys];
		return ($hasil < 0) ? $abjad[26 + $hasil] : $abjad[$hasil];

	}
	
	public function decrypt($kunci,$pesan){
		$pesan = str_split(str_replace(" ",'',$pesan));
		$kunci = str_split(str_replace(" ","",$kunci));
		$jumlah_kunci = count($kunci);
		$no_kunci = 0;
		$hasil = '';
		foreach($pesan as $key => $value){
			$hasil .= $this->__rumus_decript($kunci[$no_kunci], $value);
			$no_kunci = (++$no_kunci == $jumlah_kunci) ? 0 : $no_kunci;
		}
		return $hasil;
	}
}
