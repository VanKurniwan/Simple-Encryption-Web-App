<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            {{-- Title --}}
            <h2
                class="mb-4 text-4xl leading-relaxed tracking-tight font-extrabold text-center text-gray-900 dark:text-white">
                🔒Encryption & 🔑Decryption <br> Demo Web App
            </h2>
            <p class="mb-8 lg:mb-8 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">
                Created by <br> Ivan Kurniawan - 21330029
            </p>

            {{-- Settings --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid grid-cols-4 gap-4">
                {{-- Salt --}}
                <div class="col-span-2">
                    <label for="salt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Salt
                    </label>
                    <input type="text" name="salt" id="salt" wire:model='salt'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Masukkan Salt untuk keamanan enkripsi tambahan">
                </div>
                {{-- Metode Enkripsi --}}
                <div class="col-span-2">
                    <label for="metode-ekripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode
                        Enkripsi
                    </label>
                    <select id="metode-ekripsi" wire:model='metodeEnkripsi'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Pilih Metode Enkripsi</option>
                        <option value="AES">AES</option>
                        <option value="3DES">3DES</option>
                        <option value="Twofish">Twofish</option>
                    </select>
                </div>
            </div>

            {{-- Enkripsi --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <form wire:submit.prevent='submitEnkripsi' action="#" class="space-y-6">
                <div>
                    <label for="plain-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plain
                        Text</label>
                    <input type="text" id="plain-text" wire:model='plainText'
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="Tuliskan text yang ingin anda enkripsi" required>
                </div>
                @if (session('encrypted'))
                    <div>
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Encrypted
                            Text:</label>
                        <textarea id="message" rows="6"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Leave a comment...">{{ session('encrypted') }}</textarea>
                    </div>
                @endif
                <div class="flex justify-center">
                    <button type="submit"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        🔒 Enkripsi Text
                    </button>
                </div>
            </form>

            {{-- Dekripsi --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <form wire:submit.prevent='submitDekripsi' action="#" class="space-y-6">
                <div>
                    <label for="encrypted-text"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Encrypted Text</label>
                    <input type="text" id="encrypted-text" wire:model='encryptedText'
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="Tuliskan text yang ingin anda dekripsi" required>
                </div>
                @if (session('decrypted'))
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Decrypted Text: <span class="text-amber-600">{{ session('decrypted') }}</span>
                        </label>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Decrypted Salt: <span class="text-amber-600">{{ session('salt') }}</span>
                        </label>
                    </div>
                @endif
                {{-- <div>
                    <label for="encrypted-text"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plain Text</label>
                    <input type="text" id="encrypted-text"
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="--- Hasil dekripsi ---" disabled>
                </div> --}}
                <div class="flex justify-center">
                    <button type="submit"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        🔑 Dekripsi Text
                    </button>
                </div>
            </form>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        </div>
    </section>
</div>
