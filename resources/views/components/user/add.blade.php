<div>
    <form action="{{url('/add-user')}}" method="post">
        @csrf
    <div class="flex items-center justify-between p-6">
        <div class="flex flex-col">
            <h2 class="text-lg lg:text-3xl font-semibold text-gray-200">Add New User</h2>
            <h4 class="lg:text-base text-sm text-gray-400">Manage system users and their access permissions</h4>
        </div>

        <button type="button" @click="tab = 'list'" class="border border-gray-900 hover:border-indigo-900 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50">
            <x-heroicon-s-arrow-small-left class="h-4 w-4" />
            Back
        </button>
    </div>

    <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-4 rounded-lg">

        <h2 class="text-md lg:text-2xl font-semibold text-gray-200">User Information</h2>
        <h4 class="lg:text-base text-sm text-gray-400 mb-6">Add a new user to the system. All users will be able to log in and access the system based on their role.</h4>
                <div class="flex flex-col gap-6">

                    <div class="flex flex-col lg:flex-row w-full gap-6 justify-between">

                        <div class="w-full">
                            <label class="fieldset-legend text-gray-200 text-sm">Full Name</label>
                            <input type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200" class="bg-gray-800" placeholder="Gideon Cauyan" name="name"/>
                        </div>

                        <div class="w-full">
                            <label class="fieldset-legend text-gray-200 text-sm">Email Address</label>
                            <input type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200" class="bg-gray-800" placeholder="user@gmail.com" name="email"/>
                            <span class="text-xs text-gray-400">This will be used for login and notifications.</span>

                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row w-full gap-6 justify-between">

                        <div class="w-full">
                            <label class="fieldset-legend text-gray-200 text-sm">Password</label>
                            <input type="password" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200" class="bg-gray-800" name="password"/>
                            <span class="text-xs text-gray-400">Must be at least 8 characters with uppercase, lowercase, and numbers.</span>

                        </div>

                        <div class="w-full">
                            <label class="fieldset-legend text-gray-200 text-sm">User Role</label>
                            <select name="role" class="select select-primary w-full bg-gray-800 border border-gray-600 text-xs pl-3 text-gray-300">
                                <option disabled selected class="text-gray-300">Select a role</option>
                                <option class="text-gray-300" value="student">Student</option>
                                <option class="text-gray-300" value="faculty/staff">Faculty/Staff</option>
                                <option class="text-gray-300" value="technician">Technician</option>
                                <option class="text-gray-300" value="admin">Admin</option>
                              </select>
                            <span class="text-xs text-gray-400">This determines what permissions the user will have.</span>

                        </div>
                    </div>
                <div>

                    <div class="flex justify-between mt-10">
                        <button class="flex text-sm text-gray-200">Back</button>
                        <button class="flex hover:bg-indigo-400 text-sm text-gray-200 bg-indigo-500 px-4 py-2 rounded-md gap-2 items-center"><x-lucide-save class="h-4 w-4" /> Save</button>
                    </div>
            </div>
        </div>
    </div>
</form>
</div>