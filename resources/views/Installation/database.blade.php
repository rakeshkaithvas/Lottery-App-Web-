@extends('Installation.layout')

@section('content')
<div class="w-full px-20 pt-12">

    @include('Admin.partials.alerts.install_error')

    <div class="grid grid-cols-12 md:gap-x-6 gap-y-6">

        {{-- Content --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white shadow rounded-lg mb-6">

                {{-- Section title --}}
                <div class="bg-gray-50 mb-14 px-6 py-6 rounded-t-lg border-b-2 border-gray-100">
                    <h2 class="text-xs tracking-widest uppercase leading-6 font-bold text-gray-600">
                        database
                    </h2>
                    <p class="text-xs text-gray-500">
                        Set your database to make a connection
                    </p>
                </div>

                {{-- Section body --}}
                <form action="{{ route('connect.db') }}" method="post">
                    @csrf
                    <div class="w-full mb-8 px-6 pb-8">

                        {{-- Host --}}
                        <div class="w-full mt-4">
                            <div>
                                <label for="text-input-component-id-username"
                                    class="block text-[0.8125rem] font-medium tracking-wide text-gray-700 dark:text-white">HOST</label>
                                <div class="mt-2 relative">
                                    <input type="text" placeholder="Enter database host" name="host" value="localhost"
                                        id="text-input-component-id-username" onfocus=""  required
                                        class="disabled:cursor-not-allowed focus:!ring-1 block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-3.5 placeholder:font-normal placeholder:text-[13px] dark:placeholder-zinc-300 text-sm font-medium text-zinc-800 dark:text-white rounded-md dark:bg-transparent focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-500">
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                                        <i class="mdi mdi-account text-gray-400"></i>
                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- Port --}}
                        <div class="w-full mt-4">
                            <div>
                                <label for="text-input-component-id-username"
                                    class="block text-[0.8125rem] font-medium tracking-wide text-gray-700 dark:text-white">Port</label>
                                <div class="mt-2 relative">
                                    <input type="text" placeholder="Enter database port" name="port" value="3306"
                                        id="text-input-component-id-username" onfocus="" required
                                        class="disabled:cursor-not-allowed focus:!ring-1 block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-3.5 placeholder:font-normal placeholder:text-[13px] dark:placeholder-zinc-300 text-sm font-medium text-zinc-800 dark:text-white rounded-md dark:bg-transparent focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-500">
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                                        <i class="mdi mdi-account text-gray-400"></i>
                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- Database --}}
                        <div class="w-full mt-4">
                            <div>
                                <label for="text-input-component-id-username"
                                    class="block text-[0.8125rem] font-medium tracking-wide text-gray-700 dark:text-white">Database Name</label>
                                <div class="mt-2 relative">
                                    <input type="text" placeholder="Enter database name" name="database"
                                        id="text-input-component-id-username" onfocus="" required
                                        class="disabled:cursor-not-allowed focus:!ring-1 block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-3.5 placeholder:font-normal placeholder:text-[13px] dark:placeholder-zinc-300 text-sm font-medium text-zinc-800 dark:text-white rounded-md dark:bg-transparent focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-500">
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                                        <i class="mdi mdi-account text-gray-400"></i>
                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- Username --}}
                        <div class="w-full mt-4">
                            <div>
                                <label for="text-input-component-id-username"
                                    class="block text-[0.8125rem] font-medium tracking-wide text-gray-700 dark:text-white">Database username</label>
                                <div class="mt-2 relative">
                                    <input type="text" placeholder="Enter databse username" name="username"
                                        id="text-input-component-id-username" onfocus="" required
                                        class="disabled:cursor-not-allowed focus:!ring-1 block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-3.5 placeholder:font-normal placeholder:text-[13px] dark:placeholder-zinc-300 text-sm font-medium text-zinc-800 dark:text-white rounded-md dark:bg-transparent focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-500">
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                                        <i class="mdi mdi-account text-gray-400"></i>
                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="w-full mt-4">
                            <div>
                                <label for="text-input-component-id-username"
                                    class="block text-[0.8125rem] font-medium tracking-wide text-gray-700 dark:text-white">Database password</label>
                                <div class="mt-2 relative">
                                    <input type="text" placeholder="Enter database user password" name="password"
                                        id="text-input-component-id-username" onfocus=""
                                        class="disabled:cursor-not-allowed focus:!ring-1 block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-3.5 placeholder:font-normal placeholder:text-[13px] dark:placeholder-zinc-300 text-sm font-medium text-zinc-800 dark:text-white rounded-md dark:bg-transparent focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-500">
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                                        <i class="mdi mdi-account text-gray-400"></i>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


            </div>

            {{-- Actions --}}
            <div class="flex justify-end items-center">
                <div></div>
                <div>
                        <button type="submit"
                        wire:loading.class="bg-gray-200 hover:bg-gray-300 text-gray-500 dark:bg-zinc-600 dark:text-zinc-400 cursor-not-allowed "
                        wire:loading.class.remove="bg-primary-600 hover:bg-primary-700 text-white cursor-pointer"
                        wire:loading.attr="disabled"
                        class=" text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer">


                        {{-- <div wire:loading="" wire:target="next">
                            <svg role="status" class="inline w-4 h-4 text-gray-700 animate-spin" viewBox="0 0 100 101"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB"></path>
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div> --}}


                        <div class="next">
                            Continue
                        </div>
                    </a>
                </div>
            </div>
        </form>
        </div>

                {{-- Steps --}}
                <div class="col-span-12 lg:col-span-4">
                    <div class="bg-white shadow rounded-lg border border-gray-50 px-6 py-8">
                        <nav aria-label="Progress">
                            <ol role="list" class="overflow-hidden">


                                <li class="relative pb-8">
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-primary-600" aria-hidden="true"></div>
                                    <div class="relative flex items-center group" aria-current="step">
                                        <span class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-primary-600 rounded-full group-hover:bg-indigo-800">
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="text-xs font-semibold tracking-wide uppercase text-primary-600">
                                                Get started
                                            </span>
                                        </span>
                                    </div>
                                </li>


                                <li class="relative pb-8">
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-primary-600"></div>
                                    <div class="relative flex items-center group">
                                        <span class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-primary-600 rounded-full group-hover:bg-indigo-800">
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="text-xs font-semibold tracking-wide uppercase text-primary-600">Requirements</span>
                                        </span>
                                    </div>
                                </li>


                                <li class="relative pb-8">
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-gray-300"></div>
                                    <div class="relative flex items-center group">
                                        <span class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-primary-600 rounded-full">
                                                <span class="h-2.5 w-2.5 bg-primary-600 rounded-full"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="text-xs font-semibold tracking-wide uppercase text-primary-600">Database</span>
                                        </span>
                                    </div>
                                </li>


                                <li class="relative pb-8">
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-gray-300"></div>
                                    <div class="relative flex items-center group">
                                        <span class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="text-xs font-semibold tracking-wide uppercase text-gray-500">Administrator</span>
                                        </span>
                                    </div>
                                </li>


                                <li class="relative pb-8">
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-gray-300"></div>
                                    <div class="relative flex items-center group">
                                        <span class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="text-xs font-semibold tracking-wide uppercase text-gray-500">Cron jobs</span>
                                        </span>
                                    </div>
                                </li>


                                <li class="relative">
                                    <div class="relative flex items-center group">
                                        <span class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="text-xs font-semibold tracking-wide uppercase text-gray-500">Finish</span>
                                        </span>
                                    </div>
                                </li>

                            </ol>
                            @include('Admin.partials.author')
                        </nav>

                    </div>
                </div>
    </div>
</div>

@endsection
