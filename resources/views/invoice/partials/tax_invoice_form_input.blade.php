<label class="d-flex align-items-center fs-6 fw-semibold mt-2 mb-2">
    <span class="required">Code Transaction</span>
</label>
<select name="code_transaction" aria-label="Select Code Transaction" data-allow-clear="true"
        data-control="select2" required data-dropdown-parent="#{{$dataDropdownParent}}"
        data-placeholder="Select Code Transaction"
        class="form-select form-select-solid form-select-lg">
    <option value="04">04 - DPP Nilai Lain</option>
    <option value="07">07 - Fasilitas PPN/PPnBM Tidak Dipungut</option>
    <option value="01">01 - Non-Pemungut PPN</option>
    <option value="02">02 - Pemungut PPN Instansi Pemerintah</option>
    <option value="03">03 - Pemungut PPN Non-Instansi Pemerintah</option>
    <option value="05">05 - Besaran Tertentu</option>
    <option value="06">06 - Orang Pribadi Paspor Luar Negeri</option>
    <option value="08">08 - Fasilitas PPN/PPnBM Dibebaskan</option>
    <option value="09">09 - Penyerahan Aktiva (16D UU PPN)</option>
    <option value="10">10 - Penyerahan Lainnya</option>
</select>

<label class="d-flex align-items-center fs-6 fw-semibold mt-2 mb-2">
    <span>Additional Information</span>
</label>
<select name="additional_information" aria-label="Select Additional Information" data-allow-clear="true"
        data-control="select2" data-dropdown-parent="#{{$dataDropdownParent}}"
        data-placeholder="Select Additional Information"
        class="form-select form-select-solid form-select-lg">
    <option value=""></option>
    <option value="TD.01101">1 - Kawasan Bebas</option>
    <option value="TD.01102">2 - Tempat Penimbunan Berikat</option>
    <option value="TD.01109">9 - Penyerahan BKP di KEK</option>
    <option value="TD.01117">17 - KEK (PP No. 40/2021)</option>
    <option value="TD.01118">18 - Kawasan Bebas (PP No. 41/2021)</option>
    <option value="TD.01103">3 - Hibah/Bantuan Luar Negeri</option>
    <option value="TD.01104">4 - Avtur</option>
    <option value="TD.01105">5 - Lainnya</option>
    <option value="TD.01106">6 - Kontraktor PKP Batubara Generasi I</option>
    <option value="TD.01107">7 - BBM Kapal Angkutan Laut LN</option>
    <option value="TD.01108">8 - JKP Alat Angkutan Tertentu</option>
    <option value="TD.01110">10 - BKP Strategis (Anode Slime)</option>
    <option value="TD.01111">11 - Alat Angkutan & JKP Terkait</option>
    <option value="TD.01112">12 - KK Migas (PP No. 27/2017)</option>
    <option value="TD.01113">13 - Rumah Tapak/Sarusun Ditanggung Pemerintah (2021)</option>
    <option value="TD.01114">14 - Sewa Bangunan Pedagang Eceran (2021)</option>
    <option value="TD.01115">15 - Barang/Jasa Penanganan COVID-19 (PMK 239/2020)</option>
    <option value="TD.01116">16 - Insentif Rumah Tapak/Sarusun (PMK 103/2021)</option>
    <option value="TD.01119">19 - Rumah Tapak/Sarusun Ditanggung Pemerintah (2022)</option>
    <option value="TD.01120">20 - PPN Penanganan Pandemi Corona</option>
    <option value="TD.01121">21 - KK Migas (PP No. 53/2017)</option>
    <option value="TD.01122">22 - BKP Strategis (Anode Slime & Emas)</option>
    <option value="TD.01123">23 - Kertas Koran/Majalah</option>
    <option value="TD.01124">24 - PPN Tidak Dipungut Pemerintah</option>
    <option value="TD.01125">25 - BKP & JKP Tertentu</option>
    <option value="TD.01126">26 - BKP/JKP di Ibu Kota Baru</option>
    <option value="TD.01127">27 - Kendaraan Listrik Baterai</option>
    <option value="TD.01101">1 - BKP & JKP Tertentu</option>
    <option value="TD.01102">2 - BKP Strategis</option>
    <option value="TD.01103">3 - Jasa Kebandarudaraan</option>
    <option value="TD.01104">4 - Lainnya</option>
    <option value="TD.01105">5 - BKP Strategis (PP No. 81/2015)</option>
    <option value="TD.01106">6 - Jasa Kepelabuhan (Angkutan Laut LN)</option>
    <option value="TD.01107">7 - Air Bersih</option>
    <option value="TD.01108">8 - BKP Strategis (PP No. 48/2020)</option>
    <option value="TD.01109">9 - Perwakilan Negara Asing & Badan Internasional</option>
    <option value="TD.01110">10 - BKP & JKP Tertentu</option>
</select>

<label class="d-flex align-items-center fs-6 fw-semibold mt-2 mb-2">
    <span>Cap Fasilitas</span>
</label>
<select name="facility_stamp" aria-label="Select Facility Stamp" data-allow-clear="true"
        data-control="select2" data-dropdown-parent="#{{$dataDropdownParent}}"
        data-placeholder="Select Facility Stamp"
        class="form-select form-select-solid form-select-lg">
    <option value=""></option>
    <option value="TD.00502">2 - Tidak Dipungut Berdasarkan PMK 194/2012</option>
    <option value="TD.00517">17 - Ditanggung Pemerintah Eksekusi PMK 226/2021</option>
    <option value="TD.00518">18 - Tidak Dipungut Berdasarkan PP 53/2017</option>
    <option value="TD.00501">1 - Tidak Dipungut Berdasarkan PP 10/2012</option>
    <option value="TD.00503">3 - Tidak Dipungut Berdasarkan PP 15/2015</option>
    <option value="TD.00504">4 - Tidak Dipungut Berdasarkan PP 69/2015</option>
    <option value="TD.00505">5 - Tidak Ada Cap</option>
    <option value="TD.00506">6 - Tidak Dipungut Berdasarkan PP 96/2015</option>
    <option value="TD.00507">7 - Tidak Dipungut Berdasarkan PP 106/2015</option>
    <option value="TD.00508">8 - Tidak Dipungut Berdasarkan PP 50/2019</option>
    <option value="TD.00509">9 - Tidak Dipungut Berdasarkan PP 27/2017</option>
    <option value="TD.00510">10 - Ditanggung Pemerintah Ex PMK 21/2021</option>
    <option value="TD.00511">11 - Ditanggung Pemerintah Ex PMK 102/2021</option>
    <option value="TD.00512">12 - Ditanggung Pemerintah Ex PMK 239/2020</option>
    <option value="TD.00513">13 - Ditanggung Pemerintah Eksekusi PMK 103/2021</option>
    <option value="TD.00514">14 - Tidak Dipungut Berdasarkan PP 40/2021</option>
    <option value="TD.00515">15 - Tidak Dipungut Berdasarkan PP 41/2021</option>
    <option value="TD.00516">16 - Ditanggung Pemerintah Ex PMK 6/2022</option>
    <option value="TD.00519">19 - Tidak Dipungut Berdasarkan PP 70/2021</option>
    <option value="TD.00520">20 - Ditanggung Pemerintah Ex PMK 125/2020</option>
    <option value="TD.00521">21 - Tidak Ada Cap</option>
    <option value="TD.00522">22 - Tidak Dipungut Berdasarkan PP 49/2022</option>
    <option value="TD.00523">23 - Tidak Dipungut Berdasarkan PP 12/2023</option>
    <option value="TD.00524">24 - Ditanggung Pemerintah Berdasarkan PMK 38/2023</option>
    <option value="TD.00525">25 - Tidak Ada Cap</option>
    <option value="TD.00526">26 - Tidak Dipungut Berdasarkan PP 49/2022</option>
    <option value="TD.00527">27 - Tidak Dipungut Berdasarkan PP 12/2023</option>
    <option value="TD.00501">1 - Dibebaskan Berdasarkan PP 146/2000 Jo. PP 38/2003</option>
    <option value="TD.00502">2 - Dibebaskan Berdasarkan PP 12/2001 Jo. PP 31/2007</option>
    <option value="TD.00503">3 - Dibebaskan Berdasarkan PP 28/2009</option>
    <option value="TD.00504">4 - Tidak Ada Cap</option>
    <option value="TD.00505">5 - Dibebaskan Berdasarkan PP 81/2015</option>
    <option value="TD.00506">6 - Dibebaskan Berdasarkan PP 74/2015</option>
    <option value="TD.00507">7 - Tidak Ada Cap</option>
    <option value="TD.00508">8 - Dibebaskan Berdasarkan PP 81/2015 Jo. PP 48/2020</option>
    <option value="TD.00509">9 - Dibebaskan Berdasarkan PP 47/2020</option>
    <option value="TD.00510">10 - Dibebaskan Berdasarkan PP 49/2022</option>
</select>

<label class="d-flex align-items-center fs-6 fw-semibold mt-2 mb-2">
    <span class="required">Buyer ID Type</span>
</label>
<select name="buyer_id_type" aria-label="Select Buyer ID Type" data-allow-clear="true"
        data-control="select2" required data-dropdown-parent="#{{$dataDropdownParent}}"
        data-placeholder="Select Buyer ID Type"
        class="form-select form-select-solid form-select-lg">
    <option value="TIN">TIN</option>
    <option value="National ID">National ID</option>
    <option value="Passport">Passport</option>
</select>
