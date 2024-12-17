<template>
  <main class="flex flex-col items-start rounded-none">
    <h1 data-layername="reservasiOnline" class="text-3xl font-semibold tracking-wide text-zinc-900">
      Reservasi Online
    </h1>
    <section class="flex flex-wrap gap-5 self-stretch px-6 py-5 mt-9 text-base tracking-wide leading-snug text-blue-500 bg-orange-200 rounded-lg max-md:px-5">
      <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/62cc7e7dab1a5c2d7bb9e928d94408af054a40673cba712677d944a7a26e7009?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 w-8 aspect-square" />
      <p data-layername="pastikanMengisiDataDiriDenganBenarDanPastikanKuotaTersediaPelajariSelengkapnya" class="flex-auto my-auto w-[1135px] max-md:max-w-full">
        Pastikan mengisi data diri dengan benar dan pastikan kuota tersedia. <a href="#" class="text-blue-500">Pelajari Selengkapnya</a>
      </p>
    </section>
    <section class="flex flex-col pt-3.5 pb-9 mt-4 max-w-full bg-white rounded-md w-[809px]">
      <header class="flex flex-wrap gap-4 py-4 pr-20 pl-5 bg-gray-200 rounded-md max-md:pr-5">
        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/3096623d72b2d6eb516eb251784dc5582a05ea809ab8647403a063b6eca1ba21?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 w-7 aspect-square" />
        <div class="flex gap-1.5 my-auto">
          <h2 data-layername="dataDiri" class="text-lg font-medium tracking-normal leading-none text-zinc-800">
            Data Diri
          </h2>
          <p data-layername="isiSesuaiDenganFormatYangDiminta" class="flex-auto text-base tracking-normal text-neutral-600">
            (isi sesuai dengan format yang diminta)
          </p>
        </div>
      </header>
      <form class="flex flex-col mt-8 ml-8 max-w-full w-[573px]">
        <div class="max-md:max-w-full">
          <div class="flex gap-5 max-md:flex-col">
            <div data-layername="column" class="flex flex-col w-[57%] max-md:ml-0 max-md:w-full">
              <div class="flex flex-col items-start w-full text-sm font-medium tracking-wide leading-snug text-neutral-900 max-md:mt-4">
                <label for="namaLengkap" data-layername="namaLengkap">Nama Lengkap</label>
                <input id="namaLengkap" type="text" data-layername="emailAddress" class="gap-2.5 self-stretch px-3 pt-3 pb-3 mt-1 text-base tracking-wide rounded bg-zinc-100 text-zinc-800 w-full" placeholder="Nama Lengkap" />
                <label for="nik" data-layername="nik" class="mt-5">NIK</label>
              </div>
            </div>
            <div data-layername="column" class="flex flex-col ml-5 w-[43%] max-md:ml-0 max-md:w-full">
              <div class="flex flex-col items-start w-full text-sm font-medium tracking-wide leading-snug text-neutral-900 max-md:mt-4">
                <label for="namaPanggilan" data-layername="namaPanggilan">Nama Panggilan</label>
                <input id="namaPanggilan" type="text" data-layername="emailAddress" class="gap-2.5 self-stretch px-3 pt-3 pb-3 mt-1 text-base tracking-wide rounded bg-zinc-100 text-zinc-800 w-full" placeholder="Nama Panggilan" />
                <label for="kartuIdentitas" data-layername="lampiranKartuIdentitas" class="mt-5">Lampiran Kartu Identitas</label>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-wrap gap-4 mt-2 w-full text-base tracking-wide leading-snug text-zinc-800 max-md:max-w-full">
          <input id="nik" type="text" data-layername="emailAddress" class="flex-auto gap-2.5 self-stretch px-3 pt-3 pb-3 rounded bg-zinc-100 w-full" placeholder="NIK" />
          <input id="kartuIdentitas" type="file" data-layername="emailAddress" class="gap-2.5 self-stretch px-3 pt-3 pb-3 rounded bg-zinc-100 w-full" accept="image/*,application/pdf" />
        </div>
        <label for="nomorTelefon" data-layername="nomorTelefon" class="self-start mt-6 text-sm font-medium tracking-wide leading-snug text-neutral-900">
          Nomor Telefon
        </label>
        <div class="flex flex-wrap gap-2.5 mt-3 w-full max-md:max-w-full">
          <div class="flex gap-2.5 items-center px-3 py-2.5 whitespace-nowrap rounded bg-zinc-100">
            <span data-layername="🇮🇩" class="self-stretch my-auto w-5 text-2xl font-medium text-zinc-800">
              🇮🇩
            </span>
            <span data-layername="62" class="self-stretch my-auto text-base tracking-wide leading-snug text-zinc-800 w-[60px]">
              +62
            </span>
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/a7190009af777f59c52b0ea6c20487fe9e21851fbce619d8c105c443d199dea6?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 self-stretch my-auto w-4 aspect-square" />
          </div>
          <input id="nomorTelefon" type="tel" data-layername="emailAddress" class="flex-auto gap-2.5 self-stretch px-3 pt-3 pb-3 text-base tracking-wide leading-snug rounded bg-zinc-100 text-zinc-800 w-full" placeholder="Nomor Telefon" />
        </div>
        <label for="alamat" data-layername="alamat" class="self-start mt-8 text-sm font-medium tracking-wide leading-snug text-neutral-900">
          Alamat
        </label>
        <textarea id="alamat" data-layername="emailAddress" class="gap-2.5 self-stretch px-3 py-9 mt-3 text-base tracking-wide leading-snug rounded bg-zinc-100 min-h-[91px] text-zinc-800 w-full" placeholder="Alamat"></textarea>
        <div class="flex gap-4 self-start mt-8 text-sm tracking-wide text-zinc-800">
          <input type="checkbox" id="agreement" class="w-5 h-5 bg-white rounded-md border border-solid border-stone-300" />
          <label for="agreement" data-layername="sayaBersediaUntukMenyutujuiFormulirIni" class="flex-auto my-auto">
            Saya bersedia untuk menyutujui formulir ini
          </label>
        </div>
      </form>
    </section>
    <section class="flex z-10 flex-wrap gap-5 justify-between py-2 pr-3 pl-6 mt-14 max-w-full font-medium leading-none bg-gray-200 rounded-md w-[810px] max-md:pl-5 max-md:mt-10">
      <div class="flex gap-4 my-auto text-lg tracking-normal text-zinc-800">
        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/f471dced90ded06044c4b61a71968b053496032f7d2e686bd0911ad8676aa484?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 self-start w-6 aspect-[1.09]" />
        <h3 data-layername="pilihTanggalReservasi" class="basis-auto">Pilih Tanggal Reservasi</h3>
      </div>
      <button data-layername="cekKuotaPendakian" class="gap-2.5 self-stretch py-3.5 pr-4 pl-4 text-base tracking-wide text-white rounded-md bg-neutral-400 min-h-[45px]">
        Cek Kuota Pendakian
      </button>
    </section>
    <section data-layername="calendar" class="flex flex-col justify-center px-1 py-5 max-w-full bg-white rounded-xl min-h-[396px] w-[809px]">
      <div data-layername="monthYearLine" class="flex flex-wrap gap-2.5 justify-center items-center px-8 py-4 w-full text-xl font-semibold text-center text-zinc-500 max-md:px-5 max-md:max-w-full">
        <button aria-label="Previous month">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/13205113ddbf3be86d59c08431c49a62491e9cbf59fb3a24494dd86762468518?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" />
        </button>
        <h4 data-layername="monthYear" class="flex-1 shrink self-stretch my-auto basis-0 max-md:max-w-full">
          Oktober 2024
        </h4>
        <button aria-label="Next month">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/f0d3065b02d11412c4892f78e5117fe306116c9f2c8733f5a32c84675c9c6feb?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" />
        </button>
      </div>
      <div class="self-center mt-2 max-w-full border border-solid bg-stone-300 border-stone-300 min-h-[1px] w-[355px]"></div>
      <div data-layername="dayDate" class="flex flex-col mt-2 w-full font-medium text-black whitespace-nowrap max-md:max-w-full">
        <div data-layername="dayLine" class="flex flex-wrap gap-3 justify-center items-center px-8 py-2 w-full text-xs tracking-wide leading-none uppercase max-md:px-5 max-md:max-w-full">
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">min</div>
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">sen</div>
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">sel</div>
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">rab</div>
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">kam</div>
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">jum</div>
          <div data-layername="day" class="flex-1 shrink gap-2.5 self-stretch px-2 py-0.5 my-auto">sab</div>
        </div>
        <div data-layername="dateLine" class="flex flex-col mt-1 w-full text-lg leading-none text-center max-md:max-w-full">
          <div data-layername="dateNumberLine04" class="flex flex-wrap gap-2.5 justify-center items-center px-8 py-1 w-full max-md:px-5 max-md:max-w-full">
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px] text-neutral-400">29</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px] text-neutral-400">30</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">1</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">2</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">3</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">4</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">5</button>
          </div>
          <div data-layername="dateNumberLine03" class="flex flex-wrap gap-2.5 justify-center items-center px-8 py-1 w-full max-md:px-5 max-md:max-w-full">
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">6</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">7</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">8</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">9</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">10</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">11</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">12</button>
          </div>
          <div data-layername="dateNumberLine02" class="flex flex-wrap gap-2.5 justify-center items-center px-8 py-1 w-full max-md:px-5 max-md:max-w-full">
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">13</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">14</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">15</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">16</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">17</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">18</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">19</button>
          </div>
          <div data-layername="dateNumberLine01" class="flex flex-wrap gap-2.5 justify-center items-center px-8 py-1 w-full max-md:px-5 max-md:max-w-full">
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">20</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">21</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">22</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">23</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">24</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">25</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">26</button>
          </div>
          <div data-layername="dateNumberLine05" class="flex flex-wrap gap-2.5 justify-center items-center px-8 py-1 w-full max-md:px-5 max-md:max-w-full">
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">27</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">28</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">29</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">30</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px]">31</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px] text-neutral-400">1</button>
            <button data-layername="date" class="flex-1 shrink self-stretch p-2.5 my-auto min-h-[42px] text-neutral-400">2</button>
          </div>
        </div>
      </div>
    </section>
    <section class="flex flex-col pb-8 mt-16 max-w-full bg-white rounded-md w-[810px] max-md:mt-10">
      <h3 data-layername="informasiPentingTentangReservasiBooking" class="px-6 py-5 text-lg font-medium tracking-normal leading-none bg-gray-200 rounded-md text-zinc-800 max-md:px-5 max-md:max-w-full">
        Informasi penting tentang reservasi / booking
      </h3>
      <div class="flex flex-col px-6 mt-8 w-full text-base tracking-wide max-md:px-5 max-md:max-w-full">
        <p data-layername="tarifIniTidakDapatDikembalikanJikaAndaMengubahAtauMembatalkanPemesananAndaTidakAkanMendapatkanPengembalianUangAtauKreditUntukDigunakanPadaMasaMenginapBerikutnyaPerpanjanganMasaInapAkanMembutuhkanReservasiBaruStafResepsionisAkanMenyambutTamuPadaSaatKedatanganTidakAdaPengembalianUangUntukKeterlambatanCheckInAtauCheckOutLebihAwal" class="leading-6 text-zinc-800 max-md:max-w-full">
          Tarif ini tidak dapat dikembalikan. Jika Anda mengubah atau membatalkan pemesanan, Anda tidak akan mendapatkan pengembalian uang atau kredit untuk digunakan pada masa menginap berikutnya.
          <br />Perpanjangan masa inap akan membutuhkan reservasi baru.
          <br />Staf resepsionis akan menyambut tamu pada saat kedatangan
          <br />Tidak ada pengembalian uang untuk keterlambatan check-in atau check-out lebih awal.
        </p>
        <p data-layername="byClickingTheButtonBelowIAcknowledgeThatIHaveReviewedThePrivacyStatementAndHaveReviewdAndAcceptTheRulesAndRestrictionsAndTermsOfUse" class="mt-9 text-sm tracking-wide leading-5 text-blue-500 max-md:max-w-full">
          By clicking the button below, I acknowledge that I have reviewed the <a href="#" class="text-blue-500">Privacy Statement</a> and have reviewd and accept the <a href="#" class="text-blue-500">Rules and Restrictions</a> and <a href="#" class="text-blue-500">Terms of Use</a>.
        </p>
        <button data-layername="pemesananLengkap" class="gap-2.5 self-start px-5 py-3 mt-5 font-medium leading-none text-white bg-blue-500 rounded-md">
          Pemesanan Lengkap
        </button>
        <div class="flex flex-wrap gap-2 mt-5 text-sm tracking-wide leading-snug text-neutral-600">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/d4a9e83bfe05ee609f648f2a72e28e13fccc6a5261bfdfc012c3b9a9d47b1e30?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="" class="object-contain shrink-0 w-6 aspect-square" />
          <p data-layername="kamiMenggunakanTransmisiYangAmanDanPenyimpananTerenkripsiUntukMelindungiInformasiPribadiAnda" class="flex-auto w-[726px] max-md:max-w-full">
            Kami menggunakan transmisi yang aman dan penyimpanan terenkripsi untuk melindungi informasi pribadi Anda
          </p>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
export default {
  name: 'ReservationForm',
  // Component logic can be added here
}
</script>