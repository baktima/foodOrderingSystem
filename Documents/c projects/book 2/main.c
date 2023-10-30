#include <stdio.h>
#include <stdlib.h>


/*void increament(int *v, int *w) {
        *v = *v + 1;
    }

int main() {
        int a;
        int b;
        int *pa = &a , *pb = &b;
        scanf("%d%d", &a, &b);
        increament(pa, pb);
        printf("%d%d", a , b );
    	return 0;
    	*/

 /*void calculate_the_maximum(int n, int k) {
  int i, j, l;
  int a = n;
  int b = k;

  for(i=1; i <= k; i++){
      for(j=i+1; j <= n; j++){
          for(l = 0; l < a; a = a/2){
            printf("%d", a%2);
            }
            printf("\n");
            for(l = 0; l < b; b = b/2){
            printf("%d", b%2);
            }

            }
}
}
int main() {
    int n, k;
    scanf("%d %d", &n, &k);
    calculate_the_maximum(n, k);
    return 0;
}*/

/*void calculate_the_maximum(int n, int k) {
    int max_and = -3;
    int max_or = -1;
    int max_xor = -1;


  for(int i=1; i <= k; i++){

      for(int j=i+1; j <= n; j++){
        int s = i & j;
        int  t = i | j;
        int u = i ^ j;
        printf("%d\n", t);

        if(s < k && s > max_and){
            max_and = s;
        }
        if(t < k && t > max_or){
            max_or = t;
        }
        else{max_or = 0;}

        if(t < k && t > max_xor){
            max_xor = u;
        }
            }
            }

printf("%d\n", max_and);
printf("%d\n", max_or);
printf("%d", max_xor);
// and or xor
}

int main() {
    int n, k;

    scanf("%d %d", &n, &k);
    calculate_the_maximum(n, k);
    return 0;
}
*/
/* int main(){
    int n;
    scanf("%d", &n);
    for(int i = 0 ; i < n ; i++ ){
            for(int k = i; k < n-1 ; k++){
                printf("  ");
                }
            for(int j = 2*n-1 - 2*i ; j <= 2*n-1  ; j++){
                printf("%d ",i);

        }
        printf("\n");
    }
    for(int s = 0 ; s < n-1 ; s++ ){
            for(int t = n-s; t < n+1 ; t++){
                printf("  ");
                }
            for(int u = 2*s+3; u <= 2*n-1  ; u++){
                printf("%d ", s);

        }
        printf("\n");
    }

return 0;
} */
// diamond

/*
int main(){
    char a[30];
    char b[20];
    scanf("%s\n", b);
    gets(a, sizeof(a), stdin);
    printf("%s", b);
    printf("the word is:");
    puts(a);
    return 0;


}

*/




// Bubble sort in C


// perform the bubble sort
void bubbleSort(int array[], int size) {

  // loop to access each array element
  for (int step = 0; step < size - 1; ++step) {

    // loop to compare array elements
    for (int i = 0; i < size - step - 1; ++i) {

      // compare two adjacent elements
      // change > to < to sort in descending order
      if (array[i] > array[i + 1]) {

        // swapping occurs if elements
        // are not in the intended order
        int temp = array[i];
        array[i] = array[i + 1];
        array[i + 1] = temp;
      }
    }
  }
}

// print array
/* void printArray(int array[], int size) {
  for (int i = 0; i < size; ++i) {
    printf("%d  ", array[i]);
  }
  printf("\n");
}

int main() {
  int data[] = {-2, 45, 0, 11, -9};

  // find the array's length
  int size = sizeof(data) / sizeof(data[0]);

  bubbleSort(data, size);

  printf("Sorted Array in Ascending Order:\n");
  printArray(data, size);
}
*/

int main(){
    int n;
    int k;
    int j;
    int i;
    printf("enter the number here: ");
    scanf("%d", &n);
    for(i = -n; i<=n ; i++ ){

        if(i == 0){
            i = 2;
        }
        int min_count = -i;
        if( min_count < 0){
            min_count = -min_count; // ini buat batasin biar minimalk angkanya gak boleh kurang dari segini pas loop interation ke seberapa
        }

        for(j = -n ; j <= n ; j++ ){

        if ( j < 0  && -j < min_count){
            printf("%d ", min_count);
        }
        else if(j < 0 && -j > min_count){
            printf("%d ", -j);
        }
        else if ( j == 1 || j == 0 ){
            printf("");
        }
        else if( j > 0 && j < min_count){
            printf("%d ", min_count);
        }
        else if(j > 0 && j > min_count){
            printf("%d ", j);
        }
        else{
            if(j > 0){
                printf("%d ", j); // buat selesain masalah yang ada mines diantara angkanya soalnya ada beberapa cases dimana yang atas gak kecover ama gara gara gua loop dari - makanya ada kemungkinan bisa hasilnya - makanya perlu 2 fungsi ini.
            }
            else if(j < 0){
            printf("%d ", -j);
        }
        }


    }
printf("\n");
    }
    return 0;
}
        /* if ( j < 0){
            printf("%d ", -j);
        }
        else if ( j == 1 || j == 0 ){
            printf("");
        }
        else{
            printf("%d ", j);
        } */


