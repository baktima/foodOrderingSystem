#include <stdio.h>
#include <stdlib.h>

int i;
int a = 0;
int b = 1;
int result;
int n;
int main()
{
    printf("enter your iteration: ");
    scanf("%d", &n);
 for (i=1; i <= n; i++){
        printf("%d\n", a);
        result = a + b;
        a = b;
        b = result;



 }
    return 0;
}
