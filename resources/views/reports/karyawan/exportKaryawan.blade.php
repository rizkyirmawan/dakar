<table>
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Filter</td>
		<td style="border: 2px solid black;">: {{ request()->filter == 'TM' ? 'Tanggal Masuk' : 'Status' }}</td>
	</tr>
	@if(request()->filter == 'TM')
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Dari</td>
		<td style="border: 2px solid black;">: {{ \Carbon\Carbon::parse(request()->tanggal_awal)->translatedFormat('d F Y') }}</td>
	</tr>
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Sampai</td>
		<td style="border: 2px solid black;">: {{ \Carbon\Carbon::parse(request()->tanggal_akhir)->translatedFormat('d F Y') }}</td>
	</tr>
	@elseif(request()->filter == 'ST')
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Status</td>
		<td style="border: 2px solid black;">: {{ request()->status == 1 ? 'Aktif' : 'Non Aktif' }}</td>
	</tr>
	@endif
</table>

<table>
	<thead>
		<tr>
			<th style="border: 2px solid black; font-weight: bold;">NIK</th>
			<th style="border: 2px solid black; font-weight: bold;">Nama</th>
			<th style="border: 2px solid black; font-weight: bold;">Tanggal Masuk</th>
			<th style="border: 2px solid black; font-weight: bold;">Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($employee->where('user.role', 'CO') as $karyawan)
		<tr>
			<td style="border: 2px solid black;">{{ $karyawan->nik }}</td>
			<td style="border: 2px solid black;">{{ $karyawan->nama }}</td>
			<td style="border: 2px solid black;">{{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y') }}</td>
			<td style="border: 2px solid black;">{{ $karyawan->status == 1 ? 'Aktif' : 'Non Aktif' }}</td>
		</tr>
		@endforeach
	</tbody>
</table>