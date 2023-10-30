#include <stdio.h>
#include <stdlib.h>

fib(int n){
    if( n <= 0 )
    {
     return 0;
    }
    else if (n == 1)
    {
        return 1;
    }


    else {
        return fib(n-1) + fib(n-2);
    }
}

void fun2(int c) {
    if(c == 0)
        return;
    fun2(c/2);
    printf("%d", c%2);


}

test(int par){
    par+= par - 3/5;
    return par;

}



int main()
{
    int n;
    printf("enter your number to be fibonaci: ");
    scanf("%d", &n);
    printf("%d", fib(n));
    return 0;
}
    //int c = 5;
    //printf("%d", c%2);
   /* int n;
    int j;
    printf("enter your fibonacci number: ");
    scanf("%d", &j);
    if(j >= 0 || j == 1) {
            for(n; n<=j; n++){
        printf("%d \n", fib(n));
    }
    }
    else {
        printf("enter the number above 0.");

int sum;
int f1 = 1;
int f2 = 1;
int n;
for(n=0; n<=4; n++)
    {
sum = f1+f2;
f2=f1;
f1=sum;
}
printf("%d", sum);
    }
    */













