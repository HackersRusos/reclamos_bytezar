@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'border border-gray-300 dark:border-gray-600 
                    bg-white dark:bg-gray-800 
                    text-gray-900 dark:text-gray-100 
                    placeholder-gray-400 dark:placeholder-gray-500 
                    focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                    dark:focus:border-indigo-400 dark:focus:ring-indigo-600 
                    rounded-md shadow-sm transition duration-300'
    ]) }} 
/>
