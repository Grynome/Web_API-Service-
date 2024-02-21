             </div>
             </div>
             </div>
             <!-- core:js -->
             <script src="{{ asset('assets') }}/vendors/core/core.js"></script>
             <!-- endinject -->

             <!-- Plugin js for this page -->
             <script src="{{ asset('assets') }}/vendors/prismjs/prism.js"></script>
             <script src="{{ asset('assets') }}/vendors/clipboard/clipboard.min.js"></script>
             <!-- End plugin js for this page -->

             <!-- inject:js -->
             <script src="{{ asset('assets') }}/vendors/feather-icons/feather.min.js"></script>
             <script src="{{ asset('assets') }}/js/template.js"></script>
             <!-- endinject -->

             <!-- Custom js for this page -->
             <!-- End custom js for this page -->
             @stack('js-custom')

             </body>

             </html>
