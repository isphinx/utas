#!/usr/bin/env python3

import csv

import numpy as np
from scipy import stats
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt

file = open("a.csv", "r")
file.readline()

csvReader = csv.reader(file)

fstudentID = []
fsex = []
fnationality = []
ft1Result = []
ft2Result = []
ft3Result = []
ft4Result = []
fsumResult = []
faveResult = []

mstudentID = []
msex = []
mnationality = []
mt1Result = []
mt2Result = []
mt3Result = []
mt4Result = []
msumResult = []
maveResult = []


for item in csvReader:
    if item[1] == "F":
        fstudentID.append(item[0])
        fsex.append(item[1])
        fnationality.append(item[2])
        ft1Result.append(int(item[3]))
        ft2Result.append(int(item[4]))
        ft3Result.append(int(item[5]))
        ft4Result.append(int(item[6]))
        sumR = int(item[3]) + int(item[4]) + int(item[5]) + int(item[6])
        fsumResult.append(sumR)
        faveResult.append(sumR / 4)
    else:
        mstudentID.append(item[0])
        msex.append(item[1])
        mnationality.append(item[2])
        mt1Result.append(int(item[3]))
        mt2Result.append(int(item[4]))
        mt3Result.append(int(item[5]))
        mt4Result.append(int(item[6]))
        sumR = int(item[3]) + int(item[4]) + int(item[5]) + int(item[6])
        msumResult.append(sumR)
        maveResult.append(sumR / 4)

print(stats.shapiro(faveResult))
print(stats.shapiro(maveResult))


print("female and male average:", np.mean(faveResult), np.mean(maveResult))
print(stats.ttest_ind(maveResult, faveResult, equal_var=True))
print(stats.levene(faveResult, maveResult))

print()
# print(
#     "Variance a={0:.3f}, Variance b={1:.3f}".format(
#         np.var(faveResult, ddof=1), np.var(maveResult, ddof=1)
#     )
# )
# fstatistics = min(np.var(faveResult, ddof=1), np.var(maveResult, ddof=1)) / max(
#     np.var(faveResult, ddof=1), np.var(maveResult, ddof=1)
# )  # because we estimate mean from data
# fdistribution = stats.f(
#     len(faveResult) - 1, len(maveResult) - 1
# )  # build an F-distribution object
# p_value = fdistribution.cdf(fstatistics)
# f_critical = fd.ppf(0.05)
# print(fstatistics, f_critical)
# if p_value < 0.05:
#     print("Reject H0", p_value)
# else:
#     print("Cant Reject H0", p_value)

a = faveResult
b = maveResult
# print(
#     "Variance a={0:.3f}, Variance b={1:.3f}".format(
#         np.var(a, ddof=1), np.var(b, ddof=1)
#     )
# )
# fstatistics = np.var(a, ddof=1) / np.var(
#     b, ddof=1
# )  # because we estimate mean from data
# fdistribution = stats.f(len(a) - 1, len(b) - 1)  # build an F-distribution object
# p_value = 2 * min(fdistribution.cdf(f_critical), 1 - fdistribution.cdf(f_critical))
# f_critical1 = fdistribution.ppf(0.025)
# f_critical2 = fdistribution.ppf(0.975)
# print(fstatistics, f_critical1, f_critical2)
# if p_value < 0.05:
#     print("Reject H0", p_value)
# else:
#     print("Cant Reject H0", p_value)

# F = np.var(a) / np.var(b)
# df1 = len(a) - 1
# df2 = len(b) - 1
# p_value = 1 - 2 * abs(0.5 - stats.f.cdf(F, df1, df2))
# print("var(female):", np.var(a), "var(male)", np.var(b))
# print("F:", F, "p_value", p_value)

# print(stats.ttest_rel(faveResult, maveResult))

# mu, sigma = 60, 10
# count, bins, ignored = plt.hist(faveResult, 20, normed=True)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("Average of Four Terms Results")
# plt.ylabel("Frequency")
# plt.title("Average Result Normality of Female Student")
# plt.show()

# mu, sigma = 60, 10
# count, bins, ignored = plt.hist(maveResult, 20, normed=True)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("Average of Four Terms Results")
# plt.ylabel("Frequency")
# plt.title("Average Result Normality of Male Student")
# plt.show()

# all4semester = [faveResult, maveResult]
# plt.boxplot(
#     all4semester,
#     patch_artist=True,
#     labels=["Female average result", "Male average result"],
# )
# # plt.xlabel("SEX")
# plt.title("Average Result by Sex")
# plt.ylabel("Results")
# plt.show()
