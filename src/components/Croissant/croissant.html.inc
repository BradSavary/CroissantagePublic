<section id="croissant-section" class="h-screen bg-custom-reverse flex flex-row items-center justify-between">
  <!-- Informations à gauche -->
  <div class="h-full flex flex-col items-start text-left gap-4 w-1/2 p-15 relative">
    <img src="./{{logoImage}}" alt="" class="w-40 sm:w-20" />
    <div class="h-full mt-15">
    <h1 class="font-semibold text-5xl text-custom-reverse">{{title}}<span class="font-bold text-7xl"> {{author}} !</span></h1>
    <p class="text-xl mt-5">
      {{instructions}} <br>
      <span class="font-semibold">{{revengeText}}</span> <br>
    </p>
    <h2 class="mt-12 text-4xl font-semibold">{{gageTitle}}</h2>
    <p id="gage" class="text-2xl mt-5">{{gage}} 🥐</p>
  </div>
    <p class="absolute bottom-15 text-custom bg-custom p-4 rounded-xl shadow ">
      {{contactInfo}}
    </p>
    <img draggable="false" id="close-button" src="./{{closeButtonImage}}" alt="Fermer la page" class="absolute w-12 top-4 right-4 z-10 cursor-pointer">
    <p class=" self-end mb-20 max-w-6xl text-gray-600">{{footerText}}</p>
  </div>
</div>
  <!-- Image à droite -->
  <img draggable="false" src="./{{backgroundImage}}" alt="" class="w-1/2 h-full object-cover" />
</section>