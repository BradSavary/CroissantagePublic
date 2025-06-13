<section id="accueil" class="w-full p-12 flex items-center justify-center h-screen relative">
  <div class="shadow-2xl flex flex-row justify-center max-w-4xl rounded-2xl z-20">
    <div class="flex flex-col items-center text-center bg-custom justify-center p-15 rounded-tl-2xl rounded-bl-2xl">
      <img src="./{{logoImage}}" draggable="false" alt="" class="w-48 mx-auto max-lg:hidden" />
    </div>
    <div class="p-15 bg-custom-reverse rounded-tr-2xl rounded-br-2xl">
      <h1 class="font-semibold text-4xl">{{title}}</h1>
      <p class="mt-5">{{description}}</p>
      <!--Forumulaire-->
      <form id="accueil-form" class="mt-5 flex flex-col gap-4">
        <input type="text" name="author" placeholder="{{formPlaceholder}}" class="w-full border-custom border-2 rounded p-2" /> 
        <select name="croissantType" class="w-full border-custom border-2 rounded p-2">
          <option value="default" disabled hidden selected>{{formSelectDefault}}</option>
          {{#formOptions}}
          <option value="{{.}}">{{.}}</option>
          {{/formOptions}}
        </select>
        <button type="submit" class="bg-custom rounded-full text-white text-center p-2 shadow-xl cursor-pointer  duration-500 max-sm:p-6 text-xl font-medium">Croissanter</button>
      </form>
      <!-- Conteneur pour afficher les messages d'erreur -->
      <p id="form-error" class="text-red-500 mt-2 font-medium"></p>
    </div>
    <p class="absolute bottom-15 text-center  px-15 max-w-6xl text-gray-600">{{footerText}}</p>
  </div>

  <img src="./{{backgroundImage}}" alt="" class="absolute top-0 left-0 w-full h-full object-cover opacity-20 z-10" />
</section>