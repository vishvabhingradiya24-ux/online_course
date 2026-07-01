@extends('admin.dashboard')

@section('content')
<div class="flex-1 p-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-black text-edu-navy italic uppercase">Pending Verifications</h2>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-600 px-4 py-2 rounded-xl text-xs font-bold animate-pulse">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-600 px-4 py-2 rounded-xl text-xs font-bold animate-pulse">
                {{ session('error') }}
            </div>
        @endif
    </div>
    
    <div class="bento-card overflow-hidden bg-white rounded-[30px] shadow-sm border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">User Details</th>
                    <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest text-center">Role</th>
                    <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Registered On</th>
                    <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pending_users as $user)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 bg-white rounded-2xl shadow-sm flex items-center justify-center font-black text-edu-navy border border-gray-100 overflow-hidden">
                                @if($user->profile_photo && file_exists(public_path('uploads/profile/'.$user->profile_photo)))
                                    <img src="{{ asset('uploads/profile/'.$user->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e1e4b&color=ffbc06&size=128" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-black text-edu-navy">{{ $user->name }}</p>
                                <p class="text-[10px] text-gray-400 font-bold tracking-tight">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="p-5 text-center">
                        @php
                            $userType = trim(strtolower($user->user_type));
                        @endphp

                        @if($userType == 'teacher')
                            <span class="text-[9px] font-black px-4 py-2 bg-blue-100 text-blue-600 rounded-full uppercase tracking-widest">
                                Teacher
                            </span>
                        @else
                            <span class="text-[9px] font-black px-4 py-2 bg-green-100 text-green-600 rounded-full uppercase tracking-widest">
                                Student
                            </span>
                        @endif
                    </td>

                    <td class="p-5 text-[11px] font-black text-gray-500 italic">
                        {{ $user->created_at->format('d M, Y') }}
                    </td>

                    <td class="p-5 text-right">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('admin.user.approve', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-green-600 hover:scale-105 transition-all shadow-sm">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.user.reject', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to reject this user?')" 
                                        class="bg-red-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-red-600 hover:scale-105 transition-all shadow-sm">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-user-clock text-4xl text-gray-100 mb-4"></i>
                            <p class="text-gray-400 text-sm font-bold italic tracking-wider">No pending verifications found at the moment.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection