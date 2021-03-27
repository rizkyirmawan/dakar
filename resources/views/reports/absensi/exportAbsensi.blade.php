<table>
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Filter</td>
		<td style="border: 2px solid black;">: {{ request()->filter }}</td>
	</tr>
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Periode</td>
		<td style="border: 2px solid black;">: 
			@if(request()->filter == 'Mingguan')
				{{ today()->subDays(7)->translatedFormat('d F Y') . ' - ' . today()->translatedFormat('d F Y') }}
			@elseif(request()->filter == 'Bulanan')
				{{ today()->subDays(30)->translatedFormat('d F Y') . ' - ' . today()->translatedFormat('d F Y') }}
			@elseif(request()->filter == 'Tahunan')
				{{ today()->subDays(365)->translatedFormat('d F Y') . ' - ' . today()->translatedFormat('d F Y') }}
			@endif
		</td>
	</tr>
</table>

<table>
	<thead>
		<tr>
			<th style="border: 2px solid black; font-weight: bold;">NIK</th>
			<th style="border: 2px solid black; font-weight: bold;">Nama</th>
			<th style="border: 2px solid black; font-weight: bold;">Jumlah Absen</th>
		</tr>
	</thead>
	<tbody>
		@foreach($karyawanWithAbsensi->where('user.role', 'CO') as $karyawan)
		<tr>
			<td style="border: 2px solid black;">{{ $karyawan->nik }}</td>
			<td style="border: 2px solid black;">{{ $karyawan->nama }}</td>
			<td style="border: 2px solid black;">{{ $karyawan->absensi->where('status', 1)->count() > 0 ? $karyawan->absensi->where('status', 1)->count() : 'Belum Ada' }}</td>
		</tr>
		@endforeach
	</tbody>
</table>